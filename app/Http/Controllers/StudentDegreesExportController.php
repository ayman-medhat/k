<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\ExamRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentDegreesExportController extends Controller
{
    public function pdf(Request $request)
    {
        $data = $this->getExportData($request);
        $filename = $this->sanitizeFilename($request->query('filename', 'student-degrees'), 'pdf');

        $pdf = Pdf::loadView('exports.student-degrees-pdf', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download($filename);
    }

    public function excel(Request $request)
    {
        $data = $this->getExportData($request);
        $filename = $this->sanitizeFilename($request->query('filename', 'student-degrees'), 'csv');
        $rows = $data['records'];
        $subjects = $data['examSubjects'];

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($rows, $subjects) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Student Degrees - ' . now()->format('Y-m-d')]);
            fputcsv($handle, []);

            $headerRow = ['Student'];
            foreach ($subjects as $subject) {
                $headerRow[] = $subject->name . ' (max ' . $subject->pivot->max_marks . ')';
            }
            $headerRow[] = 'Total';
            $headerRow[] = 'Percentage';
            fputcsv($handle, $headerRow);

            foreach ($rows as $record) {
                $row = [$record['student_name']];
                foreach ($record['marks'] as $mark) {
                    $row[] = $mark['marks_obtained'] ?? '';
                }
                $row[] = $record['total_obtained'] . '/' . $record['total_max'];
                $row[] = $record['percentage'] . '%';
                fputcsv($handle, $row);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    protected function sanitizeFilename(string $name, string $ext): string
    {
        $name = preg_replace('/[^a-zA-Z0-9_\-\p{Arabic}]/u', '_', $name);
        $name = trim($name, '_');
        return ($name ?: 'student-degrees') . '.' . $ext;
    }

    protected function getExportData(Request $request)
    {
        $gradeId = $request->query('grade_id');
        $sectionId = $request->query('section_id', '');
        $examId = $request->query('exam_id');

        abort_if(!$gradeId || !$examId, 400, 'grade_id and exam_id are required.');

        $exam = Exam::with('grade', 'term')->findOrFail($examId);

        $currentYear = AcademicYear::where('is_current', true)->first();
        abort_if(!$currentYear, 400, 'No current academic year set.');

        $query = Enrollment::with('student.contact')
            ->where('academic_year_id', $currentYear->id)
            ->where('grade_id', $gradeId)
            ->where('status', 'active');

        if ($sectionId) {
            $query->where('section_id', $sectionId);
        }

        $enrolledStudents = $query->get();

        $existingRecords = ExamRecord::where('exam_id', $examId)
            ->whereIn('student_id', $enrolledStudents->pluck('student_id'))
            ->get()
            ->groupBy('student_id');

        $subjects = $exam->subjects()->orderBy('name')->get();

        $records = $enrolledStudents->map(function ($enrollment) use ($existingRecords, $subjects) {
            $studentRecords = $existingRecords->get($enrollment->student_id, collect())->keyBy('subject_id');

            $marks = [];
            $totalObtained = 0;
            $totalMax = 0;

            foreach ($subjects as $subject) {
                $existing = $studentRecords->get($subject->id);
                $obtained = $existing?->marks_obtained;
                $maxMarks = $subject->pivot->max_marks;

                $marks[] = [
                    'subject_id' => $subject->id,
                    'subject_name' => $subject->name,
                    'max_marks' => $maxMarks,
                    'marks_obtained' => $obtained,
                ];

                if ($obtained !== null) {
                    $totalObtained += (float) $obtained;
                }
                $totalMax += (float) $maxMarks;
            }

            return [
                'student_id' => $enrollment->student_id,
                'student_name' => $enrollment->student->contact?->nameEn ?? 'N/A',
                'marks' => $marks,
                'total_obtained' => $totalObtained,
                'total_max' => $totalMax,
                'percentage' => $totalMax > 0 ? round(($totalObtained / $totalMax) * 100, 2) : 0,
            ];
        })->toArray();

        return [
            'exam' => $exam,
            'examSubjects' => $subjects,
            'records' => $records,
            'gradeId' => $gradeId,
            'sectionId' => $sectionId,
        ];
    }
}

<?php

namespace App\Livewire\Exams;

use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\ExamRecord;
use App\Models\Grade;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class StudentDegrees extends Component
{
    public $grade_id = '';
    public $section_id = '';
    public $exam_id = '';

    public function updatedGradeId()
    {
        $this->section_id = '';
        $this->exam_id = '';
    }

    #[Computed]
    public function grades()
    {
        return Grade::orderBy('level_order')->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function sections()
    {
        if (!$this->grade_id) {
            return collect();
        }
        return Section::where('grade_id', $this->grade_id)
            ->orderBy('name')
            ->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function exams()
    {
        if (!$this->grade_id) {
            return collect();
        }
        return Exam::where('grade_id', $this->grade_id)
            ->orderBy('date', 'desc')
            ->get(['id', 'name', 'date']);
    }

    #[Computed]
    public function examSubjects()
    {
        if (!$this->exam_id) {
            return collect();
        }
        return Exam::findOrFail($this->exam_id)
            ->subjects()
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function records()
    {
        if (!$this->exam_id || !$this->grade_id) {
            return [];
        }

        $currentYear = AcademicYear::where('is_current', true)->first();
        if (!$currentYear) {
            return [];
        }

        $query = Enrollment::with('student.contact')
            ->where('academic_year_id', $currentYear->id)
            ->where('grade_id', $this->grade_id)
            ->where('status', 'active');

        if ($this->section_id) {
            $query->where('section_id', $this->section_id);
        }

        $enrolledStudents = $query->get();

        $existingRecords = ExamRecord::where('exam_id', $this->exam_id)
            ->whereIn('student_id', $enrolledStudents->pluck('student_id'))
            ->get()
            ->groupBy('student_id');

        $subjects = $this->examSubjects;

        return $enrolledStudents->map(function ($enrollment) use ($existingRecords, $subjects) {
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
    }

    public function render()
    {
        return view('livewire.exams.student-degrees');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Enrollment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Exam::with(['grade', 'term.academicYear', 'subjects'])
            ->orderBy('date', 'desc');

        if ($request->grade_id) {
            $query->where('grade_id', $request->grade_id);
        }

        if ($request->term_id) {
            $query->where('term_id', $request->term_id);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'term_id' => 'required|exists:terms,id',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'subjects' => 'required|array|min:1',
            'subjects.*.subject_id' => 'required|exists:subjects,id',
            'subjects.*.max_marks' => 'required|numeric|min:0.01',
        ]);

        $exam = Exam::create([
            'name' => $data['name'],
            'grade_id' => $data['grade_id'],
            'term_id' => $data['term_id'],
            'date' => $data['date'],
            'description' => $data['description'] ?? null,
        ]);

        $subjectData = [];
        foreach ($data['subjects'] as $subject) {
            $subjectData[$subject['subject_id']] = ['max_marks' => $subject['max_marks']];
        }
        $exam->subjects()->sync($subjectData);

        return response()->json([
            'message' => 'Exam created successfully',
            'data' => $exam->load('grade', 'term.academicYear', 'subjects'),
        ], 201);
    }

    public function show(Exam $exam): JsonResponse
    {
        return response()->json([
            'data' => $exam->load('grade', 'term.academicYear', 'subjects', 'records.student.contact', 'records.subject'),
        ]);
    }

    public function update(Request $request, Exam $exam): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'grade_id' => 'sometimes|exists:grades,id',
            'term_id' => 'sometimes|exists:terms,id',
            'date' => 'sometimes|date',
            'description' => 'nullable|string',
            'subjects' => 'sometimes|array|min:1',
            'subjects.*.subject_id' => 'required|exists:subjects,id',
            'subjects.*.max_marks' => 'required|numeric|min:0.01',
        ]);

        $exam->update($data);

        if (isset($data['subjects'])) {
            $subjectData = [];
            foreach ($data['subjects'] as $subject) {
                $subjectData[$subject['subject_id']] = ['max_marks' => $subject['max_marks']];
            }
            $exam->subjects()->sync($subjectData);
        }

        return response()->json([
            'message' => 'Exam updated successfully',
            'data' => $exam->fresh()->load('grade', 'term.academicYear', 'subjects'),
        ]);
    }

    public function destroy(Exam $exam): JsonResponse
    {
        $exam->subjects()->detach();
        $exam->records()->delete();
        $exam->delete();
        return response()->json(['message' => 'Exam deleted successfully']);
    }

    public function marks(Exam $exam): JsonResponse
    {
        $enrolledStudents = Enrollment::with('student.contact')
            ->where('grade_id', $exam->grade_id)
            ->whereHas('academicYear', fn($q) => $q->where('is_current', true))
            ->where('status', 'active')
            ->get();

        $existingRecords = $exam->records()->get()->keyBy(fn($r) => $r->student_id . '-' . $r->subject_id);

        $subjects = $exam->subjects;

        $marks = $enrolledStudents->map(function ($enrollment) use ($subjects, $existingRecords) {
            $student = $enrollment->student;
            $subjectMarks = $subjects->map(function ($subject) use ($existingRecords, $student) {
                $key = $student->id . '-' . $subject->id;
                $record = $existingRecords->get($key);
                return [
                    'subject_id' => $subject->id,
                    'subject_name' => $subject->name,
                    'max_marks' => $subject->pivot->max_marks,
                    'marks_obtained' => $record?->marks_obtained,
                    'record_id' => $record?->id,
                    'notes' => $record?->notes,
                ];
            });

            return [
                'student_id' => $student->id,
                'student_name' => $student->contact?->nameEn ?? 'N/A',
                'subjects' => $subjectMarks,
            ];
        });

        return response()->json([
            'data' => [
                'exam' => $exam->load('grade', 'term', 'subjects'),
                'marks' => $marks,
            ],
        ]);
    }
}

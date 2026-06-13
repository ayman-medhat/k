<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamRecordController extends Controller
{
    public function store(Request $request, Exam $exam): JsonResponse
    {
        $data = $request->validate([
            'marks' => 'required|array',
            'marks.*.student_id' => 'required|exists:students,id',
            'marks.*.subject_id' => 'required|exists:subjects,id',
            'marks.*.marks_obtained' => 'nullable|numeric|min:0',
            'marks.*.notes' => 'nullable|string|max:500',
        ]);

        foreach ($data['marks'] as $mark) {
            ExamRecord::updateOrCreate(
                [
                    'exam_id' => $exam->id,
                    'student_id' => $mark['student_id'],
                    'subject_id' => $mark['subject_id'],
                ],
                [
                    'marks_obtained' => $mark['marks_obtained'] ?? null,
                    'notes' => $mark['notes'] ?? null,
                ]
            );
        }

        return response()->json([
            'message' => 'Marks saved successfully',
        ]);
    }
}

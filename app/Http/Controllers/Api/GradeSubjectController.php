<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeSubjectController extends Controller
{
    public function index(): JsonResponse
    {
        $grades = Grade::with('subjects.children')->orderBy('level_order')->get();

        return response()->json(['data' => $grades]);
    }

    public function assign(Request $request): JsonResponse
    {
        $data = $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $grade = Grade::findOrFail($data['grade_id']);
        $grade->subjects()->syncWithoutDetaching($data['subject_ids']);

        return response()->json([
            'message' => 'Subjects assigned successfully',
            'data' => $grade->fresh()->load('subjects'),
        ]);
    }

    public function remove(Request $request): JsonResponse
    {
        $data = $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $grade = Grade::findOrFail($data['grade_id']);
        $grade->subjects()->detach($data['subject_ids']);

        return response()->json([
            'message' => 'Subjects removed successfully',
            'data' => $grade->fresh()->load('subjects'),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(): JsonResponse
    {
        $grades = Grade::with('sections', 'stages', 'subjects')
            ->orderBy('level_order')
            ->get();

        return response()->json(['data' => $grades]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'level_order' => 'nullable|integer|between:0,3',
            'description' => 'nullable|string',
        ]);

        $grade = Grade::create($data);

        return response()->json([
            'message' => 'Grade created successfully',
            'data' => $grade,
        ], 201);
    }

    public function show(Grade $grade): JsonResponse
    {
        return response()->json([
            'data' => $grade->load('sections', 'stages', 'subjects.children'),
        ]);
    }

    public function update(Request $request, Grade $grade): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'name_ar' => 'sometimes|string|max:255',
            'level_order' => 'nullable|integer|between:0,3',
            'description' => 'nullable|string',
        ]);

        $grade->update($data);

        return response()->json([
            'message' => 'Grade updated successfully',
            'data' => $grade->fresh(),
        ]);
    }

    public function destroy(Grade $grade): JsonResponse
    {
        $grade->delete();
        return response()->json(['message' => 'Grade deleted successfully']);
    }
}

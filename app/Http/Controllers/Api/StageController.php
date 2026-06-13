<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index(): JsonResponse
    {
        $stages = Stage::with('grades')
            ->orderBy('level_order')
            ->get();

        return response()->json(['data' => $stages]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'level_order' => 'nullable|integer',
            'description' => 'nullable|string',
            'grade_ids' => 'array',
            'grade_ids.*' => 'exists:grades,id',
        ]);

        $stage = Stage::create($data);

        if (!empty($data['grade_ids'])) {
            $stage->grades()->sync($data['grade_ids']);
        }

        return response()->json([
            'message' => 'Stage created successfully',
            'data' => $stage->load('grades'),
        ], 201);
    }

    public function show(Stage $stage): JsonResponse
    {
        return response()->json([
            'data' => $stage->load('grades'),
        ]);
    }

    public function update(Request $request, Stage $stage): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'name_ar' => 'sometimes|string|max:255',
            'level_order' => 'nullable|integer',
            'description' => 'nullable|string',
            'grade_ids' => 'array',
            'grade_ids.*' => 'exists:grades,id',
        ]);

        $stage->update($data);

        if (isset($data['grade_ids'])) {
            $stage->grades()->sync($data['grade_ids']);
        }

        return response()->json([
            'message' => 'Stage updated successfully',
            'data' => $stage->fresh()->load('grades'),
        ]);
    }

    public function destroy(Stage $stage): JsonResponse
    {
        $stage->grades()->detach();
        $stage->delete();
        return response()->json(['message' => 'Stage deleted successfully']);
    }
}

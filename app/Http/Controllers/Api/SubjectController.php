<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(): JsonResponse
    {
        $subjects = Subject::with('children')
            ->orderBy('name')
            ->get();

        return response()->json(['data' => $subjects]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:subjects,id',
            'is_main' => 'boolean',
            'is_religion_based' => 'boolean',
            'religion' => 'nullable|string|in:Muslim,Christian',
        ]);

        $subject = Subject::create($data);

        return response()->json([
            'message' => 'Subject created successfully',
            'data' => $subject->load('children'),
        ], 201);
    }

    public function show(Subject $subject): JsonResponse
    {
        return response()->json([
            'data' => $subject->load('parent', 'children', 'grades'),
        ]);
    }

    public function update(Request $request, Subject $subject): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'name_ar' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:subjects,id',
            'is_main' => 'boolean',
            'is_religion_based' => 'boolean',
            'religion' => 'nullable|string|in:Muslim,Christian',
        ]);

        $subject->update($data);

        return response()->json([
            'message' => 'Subject updated successfully',
            'data' => $subject->fresh()->load('children'),
        ]);
    }

    public function destroy(Subject $subject): JsonResponse
    {
        $subject->delete();
        return response()->json(['message' => 'Subject deleted successfully']);
    }
}

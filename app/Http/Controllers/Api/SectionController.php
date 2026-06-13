<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Section::with('grade')->orderBy('name');

        if ($request->grade_id) {
            $query->where('grade_id', $request->grade_id);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $section = Section::create($data);

        return response()->json([
            'message' => 'Section created successfully',
            'data' => $section->load('grade'),
        ], 201);
    }

    public function show(Section $section): JsonResponse
    {
        return response()->json([
            'data' => $section->load('grade'),
        ]);
    }

    public function update(Request $request, Section $section): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'name_ar' => 'sometimes|string|max:255',
        ]);

        $section->update($data);

        return response()->json([
            'message' => 'Section updated successfully',
            'data' => $section->fresh()->load('grade'),
        ]);
    }

    public function destroy(Section $section): JsonResponse
    {
        $section->delete();
        return response()->json(['message' => 'Section deleted successfully']);
    }

    public function generate(Request $request): JsonResponse
    {
        $data = $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'count' => 'required|integer|min:1|max:26',
        ]);

        $created = Section::generateForGrade($data['grade_id'], $data['count']);

        return response()->json([
            'message' => "{$created} sections created",
            'data' => Section::where('grade_id', $data['grade_id'])->get(),
        ]);
    }
}

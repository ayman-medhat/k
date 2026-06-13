<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => AcademicYear::with('terms')->orderBy('start_date', 'desc')->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_current' => 'boolean',
        ]);

        $academicYear = AcademicYear::create($data);

        return response()->json([
            'message' => 'Academic year created successfully',
            'data' => $academicYear,
        ], 201);
    }

    public function show(AcademicYear $academicYear): JsonResponse
    {
        return response()->json([
            'data' => $academicYear->load('terms', 'enrollments'),
        ]);
    }

    public function update(Request $request, AcademicYear $academicYear): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
            'is_current' => 'boolean',
        ]);

        $academicYear->update($data);

        return response()->json([
            'message' => 'Academic year updated successfully',
            'data' => $academicYear->fresh(),
        ]);
    }

    public function destroy(AcademicYear $academicYear): JsonResponse
    {
        $academicYear->terms()->delete();
        $academicYear->delete();
        return response()->json(['message' => 'Academic year deleted successfully']);
    }

    public function setCurrent(AcademicYear $academicYear): JsonResponse
    {
        AcademicYear::where('is_current', true)->update(['is_current' => false]);
        $academicYear->update(['is_current' => true]);

        return response()->json([
            'message' => 'Academic year set as current',
            'data' => $academicYear->fresh(),
        ]);
    }
}

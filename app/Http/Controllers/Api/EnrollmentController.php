<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Enrollment::with(['student.contact', 'academicYear', 'grade', 'section'])
            ->orderBy('enrolled_at', 'desc');

        if ($request->academic_year_id) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->grade_id) {
            $query->where('grade_id', $request->grade_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'data' => $query->paginate($request->per_page ?? 20),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'grade_id' => 'required|exists:grades,id',
            'section_id' => 'nullable|exists:sections,id',
            'enrolled_at' => 'nullable|date',
            'status' => 'required|in:active,transferred,graduated,dropped',
        ]);

        $enrollment = Enrollment::create($data);

        return response()->json([
            'message' => 'Enrollment created successfully',
            'data' => $enrollment->load(['student.contact', 'academicYear', 'grade', 'section']),
        ], 201);
    }

    public function show(Enrollment $enrollment): JsonResponse
    {
        return response()->json([
            'data' => $enrollment->load(['student.contact', 'academicYear', 'grade', 'section']),
        ]);
    }

    public function update(Request $request, Enrollment $enrollment): JsonResponse
    {
        $data = $request->validate([
            'grade_id' => 'sometimes|exists:grades,id',
            'section_id' => 'nullable|exists:sections,id',
            'status' => 'sometimes|in:active,transferred,graduated,dropped',
        ]);

        $enrollment->update($data);

        return response()->json([
            'message' => 'Enrollment updated successfully',
            'data' => $enrollment->fresh()->load(['student.contact', 'academicYear', 'grade', 'section']),
        ]);
    }

    public function destroy(Enrollment $enrollment): JsonResponse
    {
        $enrollment->delete();
        return response()->json(['message' => 'Enrollment deleted successfully']);
    }
}

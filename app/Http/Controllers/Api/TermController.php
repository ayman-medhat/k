<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Term::with('academicYear')->orderBy('start_date');

        if ($request->academic_year_id) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_current' => 'boolean',
        ]);

        $term = Term::create($data);

        return response()->json([
            'message' => 'Term created successfully',
            'data' => $term->load('academicYear'),
        ], 201);
    }

    public function show(Term $term): JsonResponse
    {
        return response()->json([
            'data' => $term->load('academicYear'),
        ]);
    }

    public function update(Request $request, Term $term): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
            'is_current' => 'boolean',
        ]);

        $term->update($data);

        return response()->json([
            'message' => 'Term updated successfully',
            'data' => $term->fresh()->load('academicYear'),
        ]);
    }

    public function destroy(Term $term): JsonResponse
    {
        $term->delete();
        return response()->json(['message' => 'Term deleted successfully']);
    }

    public function setCurrent(Term $term): JsonResponse
    {
        Term::where('academic_year_id', $term->academic_year_id)
            ->where('is_current', true)
            ->update(['is_current' => false]);
        $term->update(['is_current' => true]);

        return response()->json([
            'message' => 'Term set as current',
            'data' => $term->fresh(),
        ]);
    }
}

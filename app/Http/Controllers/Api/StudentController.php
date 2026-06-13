<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Student::with(['contact', 'grade', 'section'])
            ->orderBy('id', 'desc');

        if ($request->search) {
            $query->whereHas('contact', function ($q) use ($request) {
                $q->where('nameEn', 'like', "%{$request->search}%")
                  ->orWhere('nameAr', 'like', "%{$request->search}%");
            });
        }

        return response()->json([
            'data' => $query->paginate($request->per_page ?? 20),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        if ($request->user()->isControl()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'contact_id' => 'required|exists:contacts,id|unique:students,contact_id',
            'grade_id' => 'required|exists:grades,id',
            'section_id' => 'nullable|exists:sections,id',
            'second_language_id' => 'nullable|exists:subjects,id',
            'government_code' => 'nullable|string|max:255',
            'seat_no' => 'nullable|string|max:255',
            'secret_code' => 'nullable|string|max:255',
            'father_id' => 'nullable|exists:contacts,id',
            'mother_id' => 'nullable|exists:contacts,id',
            'guardian' => 'required|in:father,mother,other',
        ]);

        $contact = Contact::find($data['contact_id']);
        if ($contact && $contact->birth_date) {
            $data['age_at_october'] = Student::calculateAgeAtOctober($contact->birth_date->format('Y-m-d'));
        }

        $student = Student::create($data);

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student->load('contact', 'grade', 'section'),
        ], 201);
    }

    public function show(Student $student): JsonResponse
    {
        return response()->json([
            'data' => $student->load('contact', 'grade', 'section', 'secondLanguage', 'father', 'mother'),
        ]);
    }

    public function update(Request $request, Student $student): JsonResponse
    {
        if ($request->user()->isControl()) {
            $data = $request->validate([
                'seat_no' => 'nullable|string|max:255',
                'secret_code' => 'nullable|string|max:255',
            ]);
            $student->update($data);

            return response()->json([
                'message' => 'Student updated successfully',
                'data' => $student->fresh()->load('contact', 'grade', 'section'),
            ]);
        }

        $data = $request->validate([
            'contact_id' => 'sometimes|exists:contacts,id|unique:students,contact_id,' . $student->id,
            'grade_id' => 'sometimes|exists:grades,id',
            'section_id' => 'nullable|exists:sections,id',
            'second_language_id' => 'nullable|exists:subjects,id',
            'government_code' => 'nullable|string|max:255',
            'seat_no' => 'nullable|string|max:255',
            'secret_code' => 'nullable|string|max:255',
            'father_id' => 'nullable|exists:contacts,id',
            'mother_id' => 'nullable|exists:contacts,id',
            'guardian' => 'sometimes|in:father,mother,other',
        ]);

        $student->update($data);

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $student->fresh()->load('contact', 'grade', 'section'),
        ]);
    }

    public function destroy(Student $student): JsonResponse
    {
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}

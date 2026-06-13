<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $allowedCategories = match ($user->role) {
            'hr' => ['Employee'],
            'student_affairs' => ['Student', 'Parent'],
            'academic' => ['Student'],
            'control' => ['Student'],
            default => null,
        };

        $query = Contact::with('parent', 'mother', 'student.grade', 'children', 'interactions')
            ->when($allowedCategories, function ($q) use ($allowedCategories) {
                $q->where(function ($q) use ($allowedCategories) {
                    foreach ($allowedCategories as $cat) {
                        $q->orWhereJsonContains('categories', $cat);
                    }
                });
            })
            ->when($request->category && $request->category !== 'All', function ($q) use ($request) {
                $q->whereJsonContains('categories', $request->category);
            })
            ->when($request->search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nameEn', 'like', "%{$search}%")
                      ->orWhere('nameAr', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest();

        return response()->json([
            'data' => $query->paginate($request->per_page ?? 10),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nameEn' => 'required|string|max:255',
            'nameAr' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'nationality' => 'required|string',
            'religion' => 'nullable|string|in:Muslim,Christian',
            'gender' => 'nullable|string|in:Male,Female',
            'national_id' => 'nullable|string',
            'passport_no' => 'nullable|string',
            'status' => 'required|string',
            'categories' => 'required|array',
            'parent_id' => 'nullable|exists:contacts,id',
            'mother_id' => 'nullable|exists:contacts,id',
        ]);

        if (($data['nationality'] ?? '') === 'Egyptian') {
            $data['passport_no'] = null;
        } else {
            $data['national_id'] = null;
        }

        $contact = Contact::create($data);

        return response()->json([
            'message' => 'Contact created successfully',
            'data' => $contact->load('parent', 'mother'),
        ], 201);
    }

    public function show(Contact $contact): JsonResponse
    {
        return response()->json([
            'data' => $contact->load('parent', 'mother', 'student.grade', 'student.section', 'interactions'),
        ]);
    }

    public function update(Request $request, Contact $contact): JsonResponse
    {
        $data = $request->validate([
            'nameEn' => 'sometimes|string|max:255',
            'nameAr' => 'sometimes|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'nationality' => 'sometimes|string',
            'religion' => 'nullable|string|in:Muslim,Christian',
            'gender' => 'nullable|string|in:Male,Female',
            'national_id' => 'nullable|string',
            'passport_no' => 'nullable|string',
            'status' => 'sometimes|string',
            'categories' => 'sometimes|array',
            'parent_id' => 'nullable|exists:contacts,id',
            'mother_id' => 'nullable|exists:contacts,id',
        ]);

        $contact->update($data);

        return response()->json([
            'message' => 'Contact updated successfully',
            'data' => $contact->fresh()->load('parent', 'mother'),
        ]);
    }

    public function destroy(Contact $contact): JsonResponse
    {
        $contact->delete();
        return response()->json(['message' => 'Contact deleted successfully']);
    }

    public function restore(Contact $contact): JsonResponse
    {
        $existingLead = Lead::where('national_id', $contact->national_id)
            ->where('status', 'Accepted')
            ->first();

        if ($existingLead) {
            $existingLead->update(['status' => 'Enrolled']);
            $lead = $existingLead;
        } else {
            $lead = Lead::create([
                'nameEn' => $contact->nameEn,
                'nameAr' => $contact->nameAr,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'nationality' => $contact->nationality,
                'religion' => $contact->religion,
                'gender' => $contact->gender,
                'national_id' => $contact->national_id,
                'passport_no' => $contact->passport_no,
                'birth_date' => $contact->birth_date,
                'status' => $contact->status,
                'source' => $contact->source,
                'notes' => $contact->notes,
                'parent_id' => null,
                'mother_id' => null,
                'grade_id' => $contact->student?->grade_id,
                'second_language_subject_id' => $contact->student?->second_language_id,
            ]);
        }

        $contact->interactions()->each(function ($interaction) use ($lead) {
            $interaction->update(['contact_id' => null, 'lead_id' => $lead->id]);
        });

        $contact->delete();

        return response()->json([
            'message' => 'Contact restored to lead successfully',
            'data' => $lead,
        ]);
    }
}

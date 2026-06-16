<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $allowedCategories = match ($user->role) {
            'hr' => ['Employee'],
            'student_affairs' => ['Student', 'Parent'],
            'academic' => ['Student'],
            'control' => ['Student'],
            'guest' => ['Student', 'Parent'],
            default => null,
        };

        $query = Lead::with('parent', 'mother', 'grade', 'children', 'interactions')
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
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
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
            'nationality' => 'nullable|string',
            'religion' => 'nullable|string|in:Muslim,Christian',
            'gender' => 'nullable|string|in:Male,Female',
            'national_id' => 'nullable|string',
            'passport_no' => 'nullable|string',
            'status' => 'required|string',
            'categories' => 'required|array',
            'parent_id' => 'nullable|exists:leads,id',
            'mother_id' => 'nullable|exists:leads,id',
            'grade_id' => 'nullable|exists:grades,id',
            'second_language_subject_id' => 'nullable|exists:subjects,id',
            'source' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if (($data['nationality'] ?? '') === 'Egyptian') {
            $data['passport_no'] = null;
        } else {
            $data['national_id'] = null;
        }

        $lead = Lead::create($data);

        return response()->json([
            'message' => 'Lead created successfully',
            'data' => $lead->load('parent', 'mother', 'grade'),
        ], 201);
    }

    public function show(Lead $lead): JsonResponse
    {
        return response()->json([
            'data' => $lead->load('parent', 'mother', 'grade', 'children', 'interactions'),
        ]);
    }

    public function update(Request $request, Lead $lead): JsonResponse
    {
        $data = $request->validate([
            'nameEn' => 'sometimes|string|max:255',
            'nameAr' => 'sometimes|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'nationality' => 'nullable|string',
            'religion' => 'nullable|string|in:Muslim,Christian',
            'gender' => 'nullable|string|in:Male,Female',
            'national_id' => 'nullable|string',
            'passport_no' => 'nullable|string',
            'status' => 'sometimes|string',
            'categories' => 'sometimes|array',
            'parent_id' => 'nullable|exists:leads,id',
            'mother_id' => 'nullable|exists:leads,id',
            'grade_id' => 'nullable|exists:grades,id',
            'second_language_subject_id' => 'nullable|exists:subjects,id',
            'source' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $lead->update($data);

        return response()->json([
            'message' => 'Lead updated successfully',
            'data' => $lead->fresh()->load('parent', 'mother', 'grade'),
        ]);
    }

    public function destroy(Lead $lead): JsonResponse
    {
        $lead->delete();

        return response()->json(['message' => 'Lead deleted successfully']);
    }

    public function accept(Lead $lead): JsonResponse
    {
        $lead->load('parent', 'mother');

        $parentContact = null;
        $motherContact = null;

        if (in_array('Student', $lead->categories ?? [])) {
            if ($lead->parent_id) {
                $parentContact = $this->acceptParentOrMother($lead->parent_id);
            }
            if ($lead->mother_id) {
                $motherContact = $this->acceptParentOrMother($lead->mother_id);
            }
        }

        $contact = $lead->transferToContact();
        if ($parentContact) {
            $contact->update(['parent_id' => $parentContact->id]);
        }
        if ($motherContact) {
            $contact->update(['mother_id' => $motherContact->id]);
        }

        $lead->update(['status' => 'Accepted']);

        return response()->json([
            'message' => 'Lead accepted and copied to contacts.',
            'data' => $contact->load('student', 'parent', 'mother'),
        ]);
    }

    private function acceptParentOrMother($leadId): ?Contact
    {
        $lead = Lead::find($leadId);
        if (!$lead) return null;

        $existing = Contact::where('national_id', $lead->national_id)
            ->orWhere('email', $lead->email)
            ->first();

        if ($existing) return $existing;

        $contact = $lead->transferToContact();
        $lead->update(['status' => 'Accepted']);
        return $contact;
    }
}

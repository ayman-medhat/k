<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use App\Models\Lead;
use App\Models\Stage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

#[Layout('layouts.app')]
class Manage extends Component
{
    use WithPagination;

    public $viewMode = 'list';

    #[Url(as: 'categories')]
    public $filterCategory = 'All';
    public $filterStage = '';

    public function updatingFilterCategory()
    {
        $this->filterStage = '';
        $this->resetPage();
    }

    public function updatingFilterStage()
    {
        $this->resetPage();
    }

    #[Computed]
    public function allStages()
    {
        return Stage::orderBy('level_order')->get();
    }

    public function delete($id)
    {
        Contact::findOrFail($id)->delete();
    }

    public function restore($id)
    {
        $contact = Contact::findOrFail($id);

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
    }

    public function render()
    {
        $user = auth()->user();

        $allowedCategories = match($user->role) {
            'hr' => ['Employee'],
            'student_affairs' => ['Student', 'Parent'],
            'academic' => ['Student'],
            'control' => ['Student'],
            default => null,
        };

        $validCategories = $allowedCategories !== null
            ? array_merge(['All'], $allowedCategories)
            : ['All', 'Parent', 'Student', 'Employee', 'Supplier', 'Partner', 'Owner'];

        if ($this->filterCategory !== 'All' && $allowedCategories !== null && !in_array($this->filterCategory, $allowedCategories)) {
            $this->filterCategory = 'All';
        }

        $categoryCounts = Contact::selectRaw("jsonb_array_elements_text(categories) as cat, count(*) as total")
            ->when($allowedCategories, fn ($q) => $q->where(function ($q) use ($allowedCategories) {
                foreach ($allowedCategories as $cat) {
                    $q->orWhereJsonContains('categories', $cat);
                }
            }))
            ->groupBy('cat')
            ->pluck('total', 'cat')
            ->toArray();

        $contactsQuery = Contact::with('parent', 'mother', 'student.grade', 'children')
            ->when($allowedCategories, function ($q) use ($allowedCategories) {
                $q->where(function ($q) use ($allowedCategories) {
                    foreach ($allowedCategories as $cat) {
                        $q->orWhereJsonContains('categories', $cat);
                    }
                });
            })
            ->when($this->filterCategory !== 'All', function ($q) {
                $categories = array_map('trim', explode(',', $this->filterCategory));
                $q->where(function ($q) use ($categories) {
                    foreach ($categories as $cat) {
                        $q->orWhereJsonContains('categories', $cat);
                    }
                });
            })
            ->when($this->filterCategory === 'Student' && $this->filterStage !== '', function ($q) {
                $q->whereHas('student.grade.stages', fn ($sq) => $sq->where('stages.id', $this->filterStage));
            })
            ->latest();

        return view('livewire.contacts.manage', [
            'contacts' => $contactsQuery->paginate(10),
            'categoryCounts' => $categoryCounts,
            'totalCount' => Contact::when($allowedCategories, function ($q) use ($allowedCategories) {
                $q->where(function ($q) use ($allowedCategories) {
                    foreach ($allowedCategories as $cat) {
                        $q->orWhereJsonContains('categories', $cat);
                    }
                });
            })->count(),
            'allowedCategories' => $validCategories,
        ]);
    }
}

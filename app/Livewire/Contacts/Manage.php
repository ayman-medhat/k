<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use App\Models\Lead;
use App\Models\Stage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class Manage extends Component
{
    use WithPagination;

    public $viewMode = 'list';
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
                'grade_id' => $contact->grade_id,
                'second_language_subject_id' => $contact->second_language_subject_id,
            ]);
        }

        $contact->interactions()->each(function ($interaction) use ($lead) {
            $interaction->update(['contact_id' => null, 'lead_id' => $lead->id]);
        });

        $contact->delete();
    }

    public function render()
    {
        $categoryCounts = Contact::selectRaw("jsonb_array_elements_text(categories) as cat, count(*) as total")
            ->groupBy('cat')
            ->pluck('total', 'cat')
            ->toArray();

        $contactsQuery = Contact::with('parent', 'mother', 'grade', 'children')
            ->when($this->filterCategory !== 'All', fn($q) => $q->whereJsonContains('categories', $this->filterCategory))
            ->when($this->filterCategory === 'Student' && $this->filterStage !== '', function ($q) {
                $q->whereHas('grade.stages', fn ($sq) => $sq->where('stages.id', $this->filterStage));
            })
            ->latest();

        return view('livewire.contacts.manage', [
            'contacts' => $contactsQuery->paginate(10),
            'categoryCounts' => $categoryCounts,
            'totalCount' => Contact::count(),
        ]);
    }
}

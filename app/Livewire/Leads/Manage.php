<?php

namespace App\Livewire\Leads;

use App\Models\Contact;
use App\Models\Lead;
use App\Models\Stage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

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
        Lead::findOrFail($id)->delete();
    }

    public function accept($id)
    {
        $lead = Lead::with('parent', 'mother')->findOrFail($id);

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

        session()->flash('message', 'Lead accepted and copied to contacts.');
    }

    private function acceptParentOrMother($leadId): ?Contact
    {
        $lead = Lead::find($leadId);

        $existing = Contact::where('national_id', $lead->national_id)
            ->orWhere('email', $lead->email)
            ->first();

        if ($existing) {
            return $existing;
        }

        $contact = $lead->transferToContact();
        $lead->update(['status' => 'Accepted']);
        return $contact;
    }

    public function render()
    {
        $categoryCounts = Lead::selectRaw("jsonb_array_elements_text(categories) as cat, count(*) as total")
            ->groupBy('cat')
            ->pluck('total', 'cat')
            ->toArray();

        $leadsQuery = Lead::with('parent', 'mother', 'grade', 'children')
            ->when($this->filterCategory !== 'All', fn ($q) => $q->whereJsonContains('categories', $this->filterCategory))
            ->when($this->filterCategory === 'Student' && $this->filterStage !== '', function ($q) {
                $q->whereHas('grade.stages', fn ($sq) => $sq->where('stages.id', $this->filterStage));
            })
            ->latest();

        return view('livewire.leads.manage', [
            'leads' => $leadsQuery->paginate(10),
            'categoryCounts' => $categoryCounts,
            'totalCount' => Lead::count(),
        ]);
    }
}

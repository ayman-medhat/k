<?php

namespace App\Livewire\Leads;

use App\Models\Contact;
use App\Models\Lead;
use App\Models\Stage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

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

        $categoryCounts = Lead::selectRaw("jsonb_array_elements_text(categories) as cat, count(*) as total")
            ->when($allowedCategories, fn ($q) => $q->where(function ($q) use ($allowedCategories) {
                foreach ($allowedCategories as $cat) {
                    $q->orWhereJsonContains('categories', $cat);
                }
            }))
            ->groupBy('cat')
            ->pluck('total', 'cat')
            ->toArray();

        $leadsQuery = Lead::with('parent', 'mother', 'grade', 'children')
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
                $q->whereHas('grade.stages', fn ($sq) => $sq->where('stages.id', $this->filterStage));
            })
            ->latest();

        return view('livewire.leads.manage', [
            'leads' => $leadsQuery->paginate(10),
            'categoryCounts' => $categoryCounts,
            'totalCount' => Lead::when($allowedCategories, function ($q) use ($allowedCategories) {
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

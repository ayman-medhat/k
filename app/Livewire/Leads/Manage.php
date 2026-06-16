<?php
// ============================================================
// Leads Pipeline Component
// Handles listing, filtering, accepting, refusing, and bulk
// operations on Leads. Parents see only their own children's
// leads (read-only). Staff see all leads in their role scope.
// ============================================================

namespace App\Livewire\Leads;

use App\Helpers\ArabicTransliterator;
use App\Models\Contact;
use App\Models\Lead;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Manage extends Component
{
    use WithPagination;

    public $viewMode = 'list';
    public $message = '';

    #[Url(as: 'categories')]
    public $filterCategory = 'All';
    public $filterStage = '';

    public $search = '';

    public $sortAge = '';

    public $selectedLeads = [];

    public $selectAll = false;

    // ----------------------------------------------------------
    // Select-all checkbox: selects all matching leads (cross-page)
    // using getFilteredQuery() to include all filter criteria.
    // ----------------------------------------------------------
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedLeads = $this->getFilteredQuery()
                ->where('status', '!=', 'Accepted')
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedLeads = [];
        }
    }

    // Reset pagination + selection when search/sort/filter changes
    public function updatingSearch()
    {
        $this->resetSelection();
        $this->resetPage();
    }

    public function updatingSortAge()
    {
        $this->resetSelection();
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->filterStage = '';
        $this->resetSelection();
        $this->resetPage();
    }

    public function updatingFilterStage()
    {
        $this->resetSelection();
        $this->resetPage();
    }

    private function resetSelection()
    {
        $this->selectedLeads = [];
        $this->selectAll = false;
    }

    #[Computed]
    public function allStages()
    {
        return Stage::orderBy('level_order')->get();
    }

    // ----------------------------------------------------------
    // Build the filtered query based on user role and filters.
    // Parents: restricted to their own children (parent_id).
    // Other roles: scoped by allowedCategories.
    // ----------------------------------------------------------
    private function getFilteredQuery()
    {
        $user = auth()->user();

        $allowedCategories = match($user->role) {
            'hr' => ['Employee'],
            'student_affairs' => ['Student', 'Parent'],
            'academic' => ['Student'],
            'control' => ['Student'],
            // Parents see only 'Student' category leads (their children)
            'parent' => ['Student'],
            'guest' => ['Student', 'Parent'],
            default => null,
        };

        $isParent = $user->role === 'parent';

        return Lead::with('parent', 'mother', 'grade', 'children')
            // Scope to parent's own children by parent_id FK
            ->when($isParent, fn ($q) => $q->where('parent_id', $user->lead_id))
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
            ->when($this->search !== '', function ($q) {
                $q->where(function ($q) {
                    $q->where('nameEn', 'ILIKE', "%{$this->search}%")
                      ->orWhere('nameAr', 'ILIKE', "%{$this->search}%")
                      ->orWhere('national_id', 'ILIKE', "%{$this->search}%");
                });
            });
    }

    public function delete($id)
    {
        abort_if(auth()->user()->isGuest(), 403);
        Lead::findOrFail($id)->delete();
        User::where('lead_id', $id)->delete();
    }

    public function translateAllNames()
    {
        abort_if(auth()->user()->isGuest(), 403);
        $count = 0;
        Lead::whereNotNull('nameAr')->where('nameAr', '!=', '')->each(function ($lead) use (&$count) {
            $latin = ArabicTransliterator::toLatin($lead->nameAr);
            if ($latin !== $lead->nameEn) {
                $lead->update(['nameEn' => $latin]);
                $count++;
            }
        });
        $this->message = "Transliterated {$count} lead(s).";
    }

    public function bulkAccept()
    {
        if (empty($this->selectedLeads)) return;

        $count = 0;
        foreach ($this->selectedLeads as $id) {
            try {
                $this->accept($id);
                $count++;
            } catch (\Exception $e) {
                // skip errors in bulk operation
            }
        }

        $this->selectedLeads = [];
        $this->message = "Accepted {$count} lead(s).";
    }

    // ----------------------------------------------------------
    // Bulk refuse: set status to 'Refused' for all selected leads
    // ----------------------------------------------------------
    public function bulkRefuse()
    {
        if (empty($this->selectedLeads)) return;

        $count = 0;
        foreach ($this->selectedLeads as $id) {
            try {
                $this->refuse($id);
                $count++;
            } catch (\Exception $e) {
                // skip errors in bulk operation
            }
        }

        $this->selectedLeads = [];
        $this->message = "Refused {$count} lead(s).";
    }

    public function accept($id)
    {
        abort_if(auth()->user()->isGuest(), 403);
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

        if (in_array('Student', $lead->categories ?? [])) {
            if ($lead->parent_id) {
                $this->ensureUserForLead(Lead::find($lead->parent_id), 'parent');
            }
            $this->ensureUserForLead($lead, 'student');
        } elseif (in_array('Parent', $lead->categories ?? [])) {
            $this->ensureUserForLead($lead, 'parent');
        } else {
            $role = match (true) {
                in_array('Employee', $lead->categories ?? []) => 'hr',
                default => null,
            };
            if ($role) {
                $this->ensureUserForLead($lead, $role);
            }
        }

        $this->message = "Lead accepted and copied to contacts.";
    }

    // ----------------------------------------------------------
    // Refuse a single lead (does NOT transfer to contacts)
    // ----------------------------------------------------------
    public function refuse($id)
    {
        abort_if(auth()->user()->isGuest(), 403);
        $lead = Lead::findOrFail($id);
        $lead->update(['status' => 'Refused']);
        $this->message = "Lead refused.";
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

    private function ensureUserForLead(?Lead $lead, string $role): ?User
    {
        if (!$lead) return null;

        $existing = User::where('lead_id', $lead->id)->first();
        if ($existing) return $existing;

        $email = $lead->national_id
            ? $lead->national_id . '@k.com'
            : ($lead->email ?? strtolower($role . '_' . $lead->id . '@school.local'));

        $existing = User::where('email', $email)->first();
        if ($existing) return $existing;

        return User::create([
            'name' => $lead->nameEn ?? $lead->nameAr,
            'email' => $email,
            'password' => Hash::make(Str::random(16)),
            'role' => $role,
            'lead_id' => $lead->id,
        ]);
    }

    public function render()
    {
        $user = auth()->user();

        $allowedCategories = match($user->role) {
            'hr' => ['Employee'],
            'student_affairs' => ['Student', 'Parent'],
            'academic' => ['Student'],
            'control' => ['Student'],
            // Parents see only their children's leads (Student category)
            'parent' => ['Student'],
            'guest' => ['Student', 'Parent'],
            default => null,
        };

        $isParent = $user->role === 'parent';

        $validCategories = $allowedCategories !== null
            ? array_merge(['All'], $allowedCategories)
            : ['All', 'Parent', 'Student', 'Employee', 'Supplier', 'Partner', 'Owner'];

        if ($this->filterCategory !== 'All' && $allowedCategories !== null && !in_array($this->filterCategory, $allowedCategories)) {
            $this->filterCategory = 'All';
        }

        // For parents, scope category counts to their own children
        $baseQuery = Lead::when($isParent, fn ($q) => $q->where('parent_id', $user->lead_id));

        $categoryCounts = (clone $baseQuery)
            ->selectRaw("jsonb_array_elements_text(categories) as cat, count(*) as total")
            ->when($allowedCategories, fn ($q) => $q->where(function ($q) use ($allowedCategories) {
                foreach ($allowedCategories as $cat) {
                    $q->orWhereJsonContains('categories', $cat);
                }
            }))
            ->groupBy('cat')
            ->pluck('total', 'cat')
            ->toArray();

        $totalCount = (clone $baseQuery)
            ->when($allowedCategories, function ($q) use ($allowedCategories) {
                $q->where(function ($q) use ($allowedCategories) {
                    foreach ($allowedCategories as $cat) {
                        $q->orWhereJsonContains('categories', $cat);
                    }
                });
            })->count();

        $leadsQuery = $this->getFilteredQuery();

        if ($this->sortAge === 'asc') {
            $leadsQuery->orderBy('birth_date', 'asc');
        } elseif ($this->sortAge === 'desc') {
            $leadsQuery->orderBy('birth_date', 'desc');
        } else {
            $leadsQuery->latest();
        }

        return view('livewire.leads.manage', [
            'leads' => $leadsQuery->paginate(10),
            'categoryCounts' => $categoryCounts,
            'totalCount' => $totalCount,
            'allowedCategories' => $validCategories,
            'isParent' => $isParent,
            'isGuest' => $user->isGuest(),
        ]);
    }
}

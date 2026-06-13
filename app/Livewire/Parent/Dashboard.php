<?php
// ============================================================
// Parent Dashboard Component
// Route: /parent — Shows children's admission status,
// allows adding new children (Student Leads) and cancelling
// non-accepted admissions.
// ============================================================

namespace App\Livewire\Parent;

use App\Helpers\ArabicTransliterator;
use App\Models\Contact;
use App\Models\Grade;
use App\Models\Lead;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    // Current parent Lead and his children (loaded fresh from DB)
    public $parentLead;
    public $children;

    // "Add/Edit Child" form fields
    public $showForm = false;
    public $editingChildId = null;
    public $childNameEn = '';
    public $childNameAr = '';
    public $childGender = '';
    public $childBirthDate = '';
    public $childGradeId = '';
    public $childNationalId = '';

    // ----------------------------------------------------------
    // Mount: load parent's lead and children
    // ----------------------------------------------------------
    public function mount()
    {
        $user = auth()->user();

        if ($user->role !== 'parent' || !$user->lead_id) {
            $this->redirect(route('dashboard'), navigate: true);
            return;
        }

        $this->parentLead = Lead::with('children.grade')->find($user->lead_id);

        if (!$this->parentLead) {
            $this->redirect(route('admission.register'), navigate: true);
            return;
        }

        $this->loadChildren();
    }

    // ----------------------------------------------------------
    // Auto-transliterate Arabic name to English on input
    // ----------------------------------------------------------
    public function updatedChildNameAr($value)
    {
        if ($value && !$this->childNameEn) {
            $this->childNameEn = ArabicTransliterator::toLatin($value);
        }
    }

    // ----------------------------------------------------------
    // Auto-extract birth_date from Egyptian national ID (14 digits)
    // Format: CYYMMDD... where C=century (3=1900s, 4=2000s)
    // ----------------------------------------------------------
    public function updatedChildNationalId($value)
    {
        if (strlen($value) === 14 && $this->parentLead->nationality === 'Egyptian') {
            $century = substr($value, 0, 1);
            $year = substr($value, 1, 2);
            $month = substr($value, 3, 2);
            $day = substr($value, 5, 2);

            $centuryPrefix = ($century === '3') ? '19' : '20';
            $this->childBirthDate = "{$centuryPrefix}{$year}-{$month}-{$day}";
        }
    }

    // ----------------------------------------------------------
    // Toggle "Add/Edit Child" form visibility
    // ----------------------------------------------------------
    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        if (!$this->showForm) {
            $this->resetForm();
        }
    }

    // ----------------------------------------------------------
    // Pre-fill form with child's data for editing
    // ----------------------------------------------------------
    public function editChild($childId)
    {
        $child = Lead::where('id', $childId)
            ->where('parent_id', $this->parentLead->id)
            ->firstOrFail();

        $this->editingChildId = $child->id;
        $this->childNameEn = $child->nameEn;
        $this->childNameAr = $child->nameAr;
        $this->childGender = $child->gender;
        $this->childBirthDate = $child->birth_date?->format('Y-m-d') ?? '';
        $this->childGradeId = (string) $child->grade_id;
        $this->childNationalId = $child->national_id ?? '';
        $this->showForm = true;
    }

    // ----------------------------------------------------------
    // Reset form fields and editing state
    // ----------------------------------------------------------
    private function resetForm()
    {
        $this->editingChildId = null;
        $this->childNameEn = '';
        $this->childNameAr = '';
        $this->childGender = '';
        $this->childBirthDate = '';
        $this->childGradeId = '';
        $this->childNationalId = '';
    }

    // ----------------------------------------------------------
    // Cancel a child's admission (non-Accepted only) — deletes
    // the Lead record entirely.
    // ----------------------------------------------------------
    public function cancelChild($childId)
    {
        $child = Lead::where('id', $childId)
            ->where('parent_id', $this->parentLead->id)
            ->firstOrFail();

        if ($child->status === 'Accepted') {
            session()->flash('error', 'Cannot cancel an accepted admission.');
            return;
        }

        User::where('lead_id', $childId)->delete();
        $child->delete();
        $this->loadChildren();
        session()->flash('message', 'Admission cancelled and child data removed.');
    }

    public function rules()
    {
        return [
            'childNameEn' => ['required', 'string', 'max:255'],
            'childNameAr' => ['required', 'string', 'max:255'],
            'childGender' => ['required', 'string', 'in:Male,Female'],
            'childBirthDate' => ['required', 'date'],
            'childGradeId' => ['required', 'exists:grades,id'],
            'childNationalId' => ['nullable', 'string', 'size:14'],
        ];
    }

    // ----------------------------------------------------------
    // Add or update a child: creates or updates a Student Lead
    // The Lead model's booted saving event will auto-extract
    // birth_date from national_id if Egyptian.
    // ----------------------------------------------------------
    public function addChild()
    {
        $this->validate();

        $data = [
            'nameEn' => $this->childNameEn,
            'nameAr' => $this->childNameAr,
            'gender' => $this->childGender,
            'birth_date' => $this->childBirthDate,
            'grade_id' => $this->childGradeId,
            'religion' => $this->parentLead->religion,
            'nationality' => $this->parentLead->nationality,
            'national_id' => $this->childNationalId,
        ];

        if ($this->editingChildId) {
            $child = Lead::where('id', $this->editingChildId)
                ->where('parent_id', $this->parentLead->id)
                ->firstOrFail();

            // Keep original status, source, categories on update
            $child->update($data);
            session()->flash('message', 'Child updated successfully!');
        } else {
            $data['categories'] = ['Student'];
            $data['status'] = 'New';
            $data['parent_id'] = $this->parentLead->id;
            $data['source'] = 'Parent Portal';
            Lead::create($data);
            session()->flash('message', 'Child added successfully!');
        }

        $this->resetForm();
        $this->showForm = false;
        $this->loadChildren();
    }

    // ----------------------------------------------------------
    // Reload children from DB, eager-load details, and link to
    // Contact/Student when status is "Accepted"
    // ----------------------------------------------------------
    private function loadChildren()
    {
        $this->parentLead->load('children.grade', 'children.mother', 'children.secondLanguageSubject');
        $this->children = $this->parentLead->children;

        foreach ($this->children as $child) {
            $child->linkedContact = null;
            $child->linkedStudent = null;
            if ($child->status === 'Accepted') {
                $child->linkedContact = Contact::where('email', $child->email)
                    ->orWhere('national_id', $child->national_id)
                    ->with('student.grade', 'student.section', 'student.secondLanguage')
                    ->first();
                if ($child->linkedContact) {
                    $child->linkedStudent = $child->linkedContact->student;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.parent.dashboard', [
            'grades' => Grade::orderBy('level_order')->get(),
        ]);
    }
}

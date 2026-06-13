<?php

namespace App\Livewire\Leads;

use App\Helpers\ArabicTransliterator;
use App\Models\Grade;
use App\Models\Lead;
use App\Models\Student;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Persist;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    use WithFileUploads;

    public ?Lead $lead = null;

    #[Persist]
    public $nameEn = '';

    #[Persist]
    public $nameAr = '';

    #[Persist]
    public $email = '';

    #[Persist]
    public $phone = '';

    #[Persist]
    public $nationality = 'Egyptian';

    #[Persist]
    public $religion = '';

    #[Persist]
    public $gender = '';

    #[Persist]
    public $national_id = '';

    #[Persist]
    public $passport_no = '';

    #[Persist]
    public $status = 'New';
    #[Persist]
    public $categories = ['Parent'];
    #[Persist]
    public $parent_id = null;
    #[Persist]
    public $mother_id = null;

    public $photo = null;

    #[Persist]
    public $birth_date = '';
    #[Persist]
    public $ageFormatted = '';

    public $creatingParentForStudent = false;
    public $creatingMotherForStudent = false;
    public $savedStudentState = [];

    #[Persist]
    public $grade_id = null;

    public $readOnly = false;

    public bool $showDuplicateModal = false;
    public ?Lead $existingDuplicate = null;

    public function mount(?Lead $lead = null)
    {
        $this->lead = $lead;

        if ($lead) {
            if ($lead->status === 'Accepted') {
                $this->readOnly = true;
            }

            $this->nameEn = $lead->nameEn;
            $this->nameAr = $lead->nameAr;
            $this->email = $lead->email;
            $this->phone = $lead->phone;
            $this->nationality = $lead->nationality;
            $this->religion = $lead->religion;
            $this->gender = $lead->gender;
            $this->national_id = $lead->national_id;
            $this->passport_no = $lead->passport_no;
            $this->status = $lead->status;
            $this->categories = $lead->categories ?? ['Parent'];
            $this->parent_id = $lead->parent_id;
            $this->mother_id = $lead->mother_id;
            $this->birth_date = $lead->birth_date?->format('Y-m-d') ?: '';
            $this->ageFormatted = $lead->birth_date
                ? Student::formatAgeAtOctober($lead->birth_date->format('Y-m-d')) ?? ''
                : '';
            $this->grade_id = $lead->grade_id;
            $this->photo = $lead->photo;
        }
    }

    public function rules()
    {
        return [
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
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|in:' . implode(',', $this->allowedCategoryOptions()),
            'photo' => $this->photo && is_object($this->photo) ? 'nullable|image|max:2048' : 'nullable',
            'parent_id' => 'nullable|exists:leads,id',
            'mother_id' => 'nullable|exists:leads,id',
        ];
    }

    #[Computed]
    public function allowedCategoryOptions(): array
    {
        $user = auth()->user();
        return match($user->role) {
            'hr' => ['Employee'],
            'student_affairs' => ['Parent', 'Student'],
            'academic' => ['Student', 'Supplier', 'Partner', 'Owner'],
            'control' => ['Student'],
            default => ['Parent', 'Student', 'Employee', 'Supplier', 'Partner', 'Owner'],
        };
    }

    #[Computed]
    public function availableGrades()
    {
        return Grade::orderBy('name')->get(['id', 'name']);
    }

    #[Computed]
    public function availableParents()
    {
        return Lead::whereJsonContains('categories', 'Parent')
            ->orderBy('nameEn')
            ->get(['id', 'nameEn', 'nameAr']);
    }

    #[Computed]
    public function availableMothers()
    {
        return Lead::whereJsonContains('categories', 'Parent')
            ->where('gender', 'Female')
            ->orderBy('nameEn')
            ->get(['id', 'nameEn', 'nameAr']);
    }

    public function toggleCategory($category)
    {
        if (in_array($category, $this->categories)) {
            $this->categories = array_values(array_diff($this->categories, [$category]));
        } elseif ($category === 'Student') {
            $this->categories = ['Student'];
        } elseif (in_array('Student', $this->categories)) {
            return;
        } else {
            $this->categories[] = $category;
        }

        if (empty($this->categories)) {
            $this->categories = ['Parent'];
        }
    }

    public function startCreatingParent()
    {
        $this->savedStudentState = [
            'nameEn' => $this->nameEn,
            'nameAr' => $this->nameAr,
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality,
            'religion' => $this->religion,
            'gender' => $this->gender,
            'national_id' => $this->national_id,
            'passport_no' => $this->passport_no,
            'status' => $this->status,
            'categories' => $this->categories,
            'mother_id' => $this->mother_id,
            'grade_id' => $this->grade_id,
            'photo' => $this->photo,
        ];

        $this->nameEn = '';
        $this->nameAr = '';
        $this->email = '';
        $this->phone = '';
        $this->nationality = 'Egyptian';
        $this->national_id = '';
        $this->passport_no = '';
        $this->status = 'New';
        $this->mother_id = null;
        $this->categories = ['Parent'];
        $this->grade_id = null;
        $this->photo = null;
        $this->resetValidation();

        $this->creatingParentForStudent = true;
    }

    public function saveParentAndReturn()
    {
        $this->validate([
            'nameEn' => 'required|string|max:255',
            'nameAr' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ]);

        $data = [
            'nameEn' => $this->nameEn,
            'nameAr' => $this->nameAr,
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality,
            'status' => $this->status,
            'categories' => ['Parent'],
        ];
        if ($this->nationality === 'Egyptian') {
            $data['national_id'] = $this->national_id;
        } else {
            $data['passport_no'] = $this->passport_no;
        }

        $newParent = Lead::create($data);

        $saved = $this->savedStudentState;
        $this->nameEn = $saved['nameEn'];
        $this->nameAr = $saved['nameAr'];
        $this->email = $saved['email'];
        $this->phone = $saved['phone'];
        $this->nationality = $saved['nationality'];
        $this->religion = $saved['religion'];
        $this->gender = $saved['gender'];
        $this->national_id = $saved['national_id'];
        $this->passport_no = $saved['passport_no'];
        $this->status = $saved['status'];
        $this->categories = $saved['categories'];
        $this->mother_id = $saved['mother_id'];
        $this->grade_id = $saved['grade_id'] ?? null;
        $this->savedStudentState = [];

    }

    public function cancelParentCreation()
    {
        $saved = $this->savedStudentState;
        $this->nameEn = $saved['nameEn'];
        $this->nameAr = $saved['nameAr'];
        $this->email = $saved['email'];
        $this->phone = $saved['phone'];
        $this->nationality = $saved['nationality'];
        $this->religion = $saved['religion'];
        $this->gender = $saved['gender'];
        $this->national_id = $saved['national_id'];
        $this->passport_no = $saved['passport_no'];
        $this->status = $saved['status'];
        $this->categories = $saved['categories'];
        $this->mother_id = $saved['mother_id'];
        $this->grade_id = $saved['grade_id'] ?? null;
        $this->photo = $saved['photo'] ?? null;
        $this->savedStudentState = [];
        $this->creatingParentForStudent = false;
        $this->creatingMotherForStudent = false;
        $this->resetValidation();
    }

    public function startCreatingMother()
    {
        $this->savedStudentState = [
            'nameEn' => $this->nameEn,
            'nameAr' => $this->nameAr,
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality,
            'religion' => $this->religion,
            'gender' => $this->gender,
            'national_id' => $this->national_id,
            'passport_no' => $this->passport_no,
            'status' => $this->status,
            'categories' => $this->categories,
            'parent_id' => $this->parent_id,
            'grade_id' => $this->grade_id,
            'photo' => $this->photo,
        ];

        $this->nameEn = '';
        $this->nameAr = '';
        $this->email = '';
        $this->phone = '';
        $this->nationality = 'Egyptian';
        $this->national_id = '';
        $this->passport_no = '';
        $this->status = 'New';
        $this->parent_id = null;
        $this->categories = ['Parent'];
        $this->gender = 'Female';
        $this->photo = null;
        $this->resetValidation();

        $this->creatingMotherForStudent = true;
    }

    public function saveMotherAndReturn()
    {
        $this->validate([
            'nameEn' => 'required|string|max:255',
            'nameAr' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ]);

        $data = [
            'nameEn' => $this->nameEn,
            'nameAr' => $this->nameAr,
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality,
            'gender' => 'Female',
            'status' => $this->status,
            'categories' => ['Parent'],
        ];
        if ($this->nationality === 'Egyptian') {
            $data['national_id'] = $this->national_id;
        } else {
            $data['passport_no'] = $this->passport_no;
        }

        $newMother = Lead::create($data);

        $saved = $this->savedStudentState;
        $this->nameEn = $saved['nameEn'];
        $this->nameAr = $saved['nameAr'];
        $this->email = $saved['email'];
        $this->phone = $saved['phone'];
        $this->nationality = $saved['nationality'];
        $this->religion = $saved['religion'];
        $this->gender = $saved['gender'];
        $this->national_id = $saved['national_id'];
        $this->passport_no = $saved['passport_no'];
        $this->status = $saved['status'];
        $this->categories = $saved['categories'];
        $this->parent_id = $saved['parent_id'];
        $this->mother_id = $newMother->id;
        $this->grade_id = $saved['grade_id'] ?? null;
        $this->photo = $saved['photo'] ?? null;
        $this->savedStudentState = [];
        $this->creatingMotherForStudent = false;
        $this->resetValidation();
        unset($this->availableMothers);
    }

    public function translateName()
    {
        if ($this->nameAr) {
            $this->nameEn = ArabicTransliterator::toLatin($this->nameAr);
        }
    }

    public function updatedBirthDate()
    {
        $this->ageFormatted = $this->birth_date
            ? Student::formatAgeAtOctober($this->birth_date) ?? ''
            : '';
    }

    public function save()
    {
        $this->validate();

        if ($this->nationality === 'Egyptian' && $this->national_id) {
            $existing = Lead::where('national_id', $this->national_id)
                ->when($this->lead, fn($q) => $q->where('id', '!=', $this->lead->id))
                ->first();

            if ($existing) {
                $this->existingDuplicate = $existing;
                $this->showDuplicateModal = true;
                return;
            }
        }

        $this->performSave();
    }

    public function confirmUpdateExisting()
    {
        if (!$this->existingDuplicate) {
            $this->showDuplicateModal = false;
            return;
        }

        $this->validate();

        $data = $this->buildSaveData();
        if ($this->photo && is_object($this->photo)) {
            $data['photo'] = $this->photo->store('photos', 'public');
        }
        $this->existingDuplicate->update($data);
        $this->showDuplicateModal = false;
        $this->existingDuplicate = null;

        $this->redirect(route('leads'), navigate: true);
    }

    public function ignoreDuplicate()
    {
        $this->showDuplicateModal = false;
        $this->existingDuplicate = null;

        $this->redirect(route('leads'), navigate: true);
    }

    protected function buildSaveData(): array
    {
        $data = [
            'nameEn' => $this->nameEn,
            'nameAr' => $this->nameAr,
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality,
            'religion' => $this->religion ?: null,
            'gender' => $this->gender ?: null,
            'status' => $this->status,
            'categories' => $this->categories,
            'parent_id' => $this->parent_id,
            'mother_id' => $this->mother_id,
            'birth_date' => $this->birth_date ?: null,
            'grade_id' => in_array('Student', $this->categories) ? $this->grade_id : null,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo;
        }

        return $data;
    }

    protected function performSave(): void
    {
        $data = $this->buildSaveData();

        if ($this->nationality === 'Egyptian') {
            $data['national_id'] = $this->national_id;
            $data['passport_no'] = null;
        } else {
            $data['passport_no'] = $this->passport_no;
            $data['national_id'] = null;
        }

        if ($this->photo && is_object($this->photo)) {
            $data['photo'] = $this->photo->store('photos', 'public');
        }

        if ($this->lead) {
            $this->lead->update($data);
        } else {
            Lead::create($data);
        }

        $this->redirect(route('leads'), navigate: true);
    }

    public function render()
    {
        return view('livewire.leads.manage-form');
    }
}

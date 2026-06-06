<?php

namespace App\Livewire\Leads;

use App\Models\Lead;
use App\Models\Student;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?Lead $lead = null;

    public $nameEn = '';

    public $nameAr = '';

    public $email = '';

    public $phone = '';

    public $nationality = 'Egyptian';

    public $religion = '';

    public $gender = '';

    public $national_id = '';

    public $passport_no = '';

    public $status = 'New';
    public $categories = ['Parent'];
    public $parent_id = null;
    public $mother_id = null;
    public $birth_date = '';
    public $ageFormatted = '';

    public $creatingParentForStudent = false;
    public $creatingMotherForStudent = false;
    public $savedStudentState = [];

    public $readOnly = false;

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
        $this->parent_id = $newParent->id;
        $this->savedStudentState = [];
        $this->creatingParentForStudent = false;
        $this->resetValidation();
        unset($this->availableParents);
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
        $this->savedStudentState = [];
        $this->creatingMotherForStudent = false;
        $this->resetValidation();
        unset($this->availableMothers);
    }

    public function updatedBirthDate()
    {
        $this->ageFormatted = $this->birth_date
            ? Student::formatAgeAtOctober($this->birth_date) ?? ''
            : '';
    }

    public function render()
    {
        return view('livewire.leads.manage-form');
    }
}

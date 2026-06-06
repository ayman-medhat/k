<?php

namespace App\Livewire\Leads;

use App\Models\Grade;
use App\Models\Lead;
use App\Models\Subject;
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
    public $grade_id = null;
    public $second_language_subject_id = null;

    public $creatingParentForStudent = false;
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
            $this->grade_id = $lead->grade_id;
            $this->second_language_subject_id = $lead->second_language_subject_id;
        }
    }

    public function rules()
    {
        return [
            'nameEn' => 'required|string|max:255',
            'nameAr' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'nationality' => 'required|string',
            'religion' => 'nullable|string|in:Muslim,Christian',
            'gender' => 'nullable|string|in:Male,Female',
            'national_id' => $this->nationality === 'Egyptian' ? 'required|digits:14|unique:leads,national_id' . ($this->lead?->id ? ',' . $this->lead->id : '') : 'nullable',
            'passport_no' => $this->nationality !== 'Egyptian' ? 'required|string' : 'nullable',
            'status' => 'required|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|in:Parent,Student,Employee,Supplier,Partner,Owner',
            'parent_id' => 'nullable|exists:leads,id',
            'mother_id' => 'nullable|exists:leads,id',
            'grade_id' => 'nullable|exists:grades,id',
            'second_language_subject_id' => 'nullable|exists:subjects,id',
        ];
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

    #[Computed]
    public function availableGrades()
    {
        return Grade::orderBy('level_order')
            ->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function secondLanguageOptions()
    {
        if (! $this->grade_id) {
            return collect();
        }

        $secondLang = Subject::where('name', 'Second Language')
            ->whereNull('parent_id')
            ->first();

        if (! $secondLang) {
            return collect();
        }

        return Subject::where('parent_id', $secondLang->id)
            ->orderBy('name')
            ->get(['id', 'name', 'name_ar']);
    }

    public function updatedGradeId()
    {
        $this->second_language_subject_id = null;
    }

    public function save()
    {
        if ($this->readOnly) {
            $this->redirect(route('leads'), navigate: true);
            return;
        }

        $this->validate();

        $isStudent = in_array('Student', $this->categories);

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
            'parent_id' => $isStudent ? $this->parent_id : null,
            'mother_id' => $isStudent ? $this->mother_id : null,
            'grade_id' => $isStudent ? $this->grade_id : null,
            'second_language_subject_id' => $isStudent ? $this->second_language_subject_id : null,
        ];

        if ($this->nationality === 'Egyptian') {
            $data['national_id'] = $this->national_id;
            $data['passport_no'] = null;
        } else {
            $data['passport_no'] = $this->passport_no;
            $data['national_id'] = null;
        }

        if ($this->lead) {
            $this->lead->update($data);
        } else {
            Lead::create($data);
        }

        $this->redirect(route('leads'), navigate: true);
    }

    public function toggleCategory($category)
    {
        if (in_array($category, $this->categories)) {
            $this->categories = array_values(array_diff($this->categories, [$category]));
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
            'grade_id' => $this->grade_id,
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
        $this->grade_id = null;
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
            'nationality' => 'required|string',
            'national_id' => $this->nationality === 'Egyptian' ? 'required|digits:14|unique:leads,national_id' : 'nullable',
            'passport_no' => $this->nationality !== 'Egyptian' ? 'required|string' : 'nullable',
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
        $this->grade_id = $saved['grade_id'];
        $this->mother_id = $saved['mother_id'];
        $this->parent_id = $newParent->id;
        $this->savedStudentState = [];
        $this->creatingParentForStudent = false;
        $this->resetValidation();
        unset($this->availableParents, $this->availableGrades);
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
        $this->grade_id = $saved['grade_id'];
        $this->mother_id = $saved['mother_id'];
        $this->savedStudentState = [];
        $this->creatingParentForStudent = false;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.leads.manage-form');
    }
}

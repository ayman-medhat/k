<?php

namespace App\Livewire\Contacts;

use App\Models\Grade;
use App\Models\Contact;
use App\Models\Subject;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?Contact $contact = null;

    public $nameEn = '';
    public $nameAr = '';
    public $email = '';
    public $phone = '';
    public $nationality = 'Egyptian';
    public $religion = '';
    public $gender = '';
    public $national_id = '';
    public $passport_no = '';
    public $status = 'Active';
    public $categories = ['Parent'];
    public $parent_id = null;
    public $mother_id = null;
    public $grade_id = null;
    public $second_language_subject_id = null;

    public function mount(?Contact $contact = null)
    {
        $this->contact = $contact;

        if ($contact) {
            $this->nameEn = $contact->nameEn;
            $this->nameAr = $contact->nameAr;
            $this->email = $contact->email;
            $this->phone = $contact->phone;
            $this->nationality = $contact->nationality;
            $this->religion = $contact->religion;
            $this->gender = $contact->gender;
            $this->national_id = $contact->national_id;
            $this->passport_no = $contact->passport_no;
            $this->status = $contact->status;
            $this->categories = $contact->categories ?? ['Parent'];
            $this->parent_id = $contact->parent_id;
            $this->mother_id = $contact->mother_id;
            $this->grade_id = $contact->grade_id;
            $this->second_language_subject_id = $contact->second_language_subject_id;
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
            'national_id' => $this->nationality === 'Egyptian' ? 'required|digits:14|unique:contacts,national_id' . ($this->contact?->id ? ',' . $this->contact->id : '') : 'nullable',
            'passport_no' => $this->nationality !== 'Egyptian' ? 'required|string' : 'nullable',
            'status' => 'required|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|in:Parent,Student,Employee,Supplier,Partner,Owner',
            'parent_id' => 'nullable|exists:contacts,id',
            'mother_id' => 'nullable|exists:contacts,id',
            'grade_id' => 'nullable|exists:grades,id',
            'second_language_subject_id' => 'nullable|exists:subjects,id',
        ];
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

    #[Computed]
    public function availableParents()
    {
        return Contact::whereJsonContains('categories', 'Parent')
            ->orderBy('nameEn')
            ->get(['id', 'nameEn', 'nameAr']);
    }

    #[Computed]
    public function availableMothers()
    {
        return Contact::whereJsonContains('categories', 'Parent')
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
        if (! $this->grade_id) return collect();

        $secondLang = Subject::where('name', 'Second Language')
            ->whereNull('parent_id')
            ->first();

        if (! $secondLang) return collect();

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

        if ($this->contact) {
            $this->contact->update($data);
        } else {
            Contact::create($data);
        }

        $this->redirect(route('contacts'), navigate: true);
    }

    public function render()
    {
        return view('livewire.contacts.manage-form');
    }
}

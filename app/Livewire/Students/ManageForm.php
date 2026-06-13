<?php

namespace App\Livewire\Students;

use App\Models\Contact;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    use WithFileUploads;

    public ?Student $student = null;

    public $contact_id = '';
    public $grade_id = '';
    public $section_id = '';
    public $second_language_id = '';
    public $government_code = '';
    public $seat_no = '';
    public $secret_code = '';
    public $father_id = '';
    public $mother_id = '';
    public $guardian = 'father';
    public $photo = null;
    public $existingPhoto = '';
    public $age_at_october = '';
    public $ageFormatted = '';

    public function mount(?Student $student = null)
    {
        if (auth()->user()->role === 'parent') {
            $this->redirect(route('parent.dashboard'), navigate: true);
            return;
        }

        if (auth()->user()->isControl() && !$student) {
            $this->redirect(route('students'), navigate: true);
            return;
        }

        $this->student = $student;

        if ($student) {
            $this->contact_id = $student->contact_id;
            $this->grade_id = $student->grade_id;
            $this->section_id = $student->section_id;
            $this->second_language_id = $student->second_language_id;
            $this->government_code = $student->government_code;
            $this->seat_no = $student->seat_no;
            $this->secret_code = $student->secret_code;
            $this->father_id = $student->father_id;
            $this->mother_id = $student->mother_id;
            $this->guardian = $student->guardian;
            $this->existingPhoto = $student->photo;
            $this->age_at_october = $student->age_at_october;
            $this->ageFormatted = $student->age_at_october
                ? $student->age_at_october . ' years'
                : '';
        }
    }

    public function rules()
    {
        if (auth()->user()->isControl()) {
            return [
                'seat_no' => 'nullable|string|max:255',
                'secret_code' => 'nullable|string|max:255',
            ];
        }

        return [
            'contact_id' => 'required|exists:contacts,id|unique:students,contact_id,' . ($this->student?->id ?: 'NULL') . ',id',
            'grade_id' => 'required|exists:grades,id',
            'section_id' => 'nullable|exists:sections,id',
            'second_language_id' => 'nullable|exists:subjects,id',
            'government_code' => 'nullable|string|max:255',
            'seat_no' => 'nullable|string|max:255',
            'secret_code' => 'nullable|string|max:255',
            'father_id' => 'nullable|exists:contacts,id',
            'mother_id' => 'nullable|exists:contacts,id',
            'guardian' => 'required|in:father,mother,other',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    #[Computed]
    public function availableContacts()
    {
        return Contact::whereJsonContains('categories', 'Student')
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
    public function availableSections()
    {
        if (!$this->grade_id) return collect();

        return Section::where('grade_id', $this->grade_id)
            ->orderBy('name')
            ->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function secondLanguageOptions()
    {
        $secondLang = Subject::where('name', 'Second Language')
            ->whereNull('parent_id')
            ->first();

        if (!$secondLang) return collect();

        return Subject::where('parent_id', $secondLang->id)
            ->orderBy('name')
            ->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function availableFathers()
    {
        return Contact::whereJsonContains('categories', 'Parent')
            ->where('gender', 'Male')
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

    public function updatedContactId()
    {
        $contact = Contact::find($this->contact_id);
        if ($contact && $contact->birth_date) {
            $this->age_at_october = Student::calculateAgeAtOctober($contact->birth_date->format('Y-m-d'));
            $this->ageFormatted = Student::formatAgeAtOctober($contact->birth_date->format('Y-m-d'));
        } else {
            $this->age_at_october = null;
            $this->ageFormatted = '';
        }
    }

    public function updatedGradeId()
    {
        $this->section_id = '';
        $this->second_language_id = '';
    }

    public function save()
    {
        $this->validate();

        if (auth()->user()->isControl()) {
            $this->student?->update([
                'seat_no' => $this->seat_no ?: null,
                'secret_code' => $this->secret_code ?: null,
            ]);
        } else {
            $data = [
                'contact_id' => $this->contact_id,
                'grade_id' => $this->grade_id,
                'section_id' => $this->section_id ?: null,
                'second_language_id' => $this->second_language_id ?: null,
                'government_code' => $this->government_code ?: null,
                'seat_no' => $this->seat_no ?: null,
                'secret_code' => $this->secret_code ?: null,
                'father_id' => $this->father_id ?: null,
                'mother_id' => $this->mother_id ?: null,
                'guardian' => $this->guardian,
                'photo' => $this->photo
                    ? $this->photo->store('students', 'public')
                    : ($this->existingPhoto ?: null),
                'age_at_october' => $this->age_at_october ?: null,
            ];

            if ($this->student) {
                $this->student->update($data);
            } else {
                Student::create($data);
            }
        }

        $this->redirect(route('students'), navigate: true);
    }

    public function render()
    {
        return view('livewire.students.manage-form', [
            'isControl' => auth()->user()->isControl(),
        ]);
    }
}

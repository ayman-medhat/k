<?php

namespace App\Livewire\Contacts;

use App\Helpers\ArabicTransliterator;
use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Persist;
use Livewire\WithFileUploads;
use App\Models\ContactDocument;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    use WithFileUploads;

    public ?Contact $contact = null;

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
    public $status = 'Active';
    #[Persist]
    public $categories = ['Parent'];
    #[Persist]
    public $parent_id = null;
    #[Persist]
    public $mother_id = null;

    public $photo = null;
    public $documents = [];
    public $documentNotes = [];

    public $creatingMotherForStudent = false;
    public $savedStudentState = [];

    public bool $showDuplicateModal = false;
    public ?Contact $existingDuplicate = null;

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
            $this->photo = $contact->photo;
        }
    }

    public function removeDocument($index)
    {
        if (isset($this->documents[$index])) {
            unset($this->documents[$index]);
            $this->documents = array_values($this->documents);
            unset($this->documentNotes[$index]);
            $this->documentNotes = array_values($this->documentNotes);
        }
    }

    public function deleteExistingDocument($docId)
    {
        $doc = ContactDocument::findOrFail($docId);
        if ($this->contact && $doc->contact_id === $this->contact->id) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($doc->file_path);
            $doc->delete();
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
            'national_id' => $this->nationality === 'Egyptian'
                ? 'nullable|digits:14|unique:contacts,national_id' . ($this->contact ? ',' . $this->contact->id : '')
                : 'nullable',
            'passport_no' => $this->nationality !== 'Egyptian'
                ? 'nullable|string|unique:contacts,passport_no' . ($this->contact ? ',' . $this->contact->id : '')
                : 'nullable',
            'status' => 'required|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|in:' . implode(',', array_unique(array_merge(
                $this->allowedCategoryOptions(),
                $this->contact ? ($this->contact->categories ?? []) : []
            ))),
            'photo' => $this->photo && is_object($this->photo) ? 'nullable|image|max:2048' : 'nullable',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'documentNotes.*' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:contacts,id',
            'mother_id' => 'nullable|exists:contacts,id',
        ];
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

    public function translateName()
    {
        if ($this->nameAr) {
            $this->nameEn = ArabicTransliterator::toLatin($this->nameAr);
        }
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
            'photo' => $this->photo,
        ];

        $this->nameEn = '';
        $this->nameAr = '';
        $this->email = '';
        $this->phone = '';
        $this->nationality = 'Egyptian';
        $this->national_id = '';
        $this->passport_no = '';
        $this->status = 'Active';
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
            'nationality' => 'required|string',
            'national_id' => $this->nationality === 'Egyptian' ? 'required|digits:14' : 'nullable',
            'passport_no' => $this->nationality !== 'Egyptian' ? 'required|string' : 'nullable',
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

        $newMother = Contact::create($data);

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
        $this->photo = $saved['photo'] ?? null;
        $this->savedStudentState = [];
        $this->creatingMotherForStudent = false;
        $this->resetValidation();
        unset($this->availableMothers);
    }

    public function cancelMotherCreation()
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
        $this->parent_id = $saved['parent_id'];
        $this->photo = $saved['photo'] ?? null;
        $this->savedStudentState = [];
        $this->creatingMotherForStudent = false;
        $this->resetValidation();
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

    public function save()
    {
        $this->validate();

        if ($this->nationality === 'Egyptian' && $this->national_id) {
            $existing = Contact::where('national_id', $this->national_id)
                ->when($this->contact, fn($q) => $q->where('id', '!=', $this->contact->id))
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

        foreach ($this->documents as $i => $doc) {
            if ($doc) {
                $path = $doc->store('contact-documents', 'public');
                $this->existingDuplicate->documents()->create([
                    'file_path' => $path,
                    'file_name' => $doc->getClientOriginalName(),
                    'file_type' => $doc->getMimeType(),
                    'notes' => $this->documentNotes[$i] ?? null,
                ]);
            }
        }

        $this->showDuplicateModal = false;
        $this->existingDuplicate = null;

        $this->redirect(route('contacts'), navigate: true);
    }

    public function ignoreDuplicate()
    {
        $this->showDuplicateModal = false;
        $this->existingDuplicate = null;

        $this->redirect(route('contacts'), navigate: true);
    }

    protected function buildSaveData(): array
    {
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
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo;
        }

        if ($this->nationality === 'Egyptian') {
            $data['national_id'] = $this->national_id;
            $data['passport_no'] = null;
        } else {
            $data['passport_no'] = $this->passport_no;
            $data['national_id'] = null;
        }

        return $data;
    }

    protected function performSave(): void
    {
        $data = $this->buildSaveData();

        if ($this->photo && is_object($this->photo)) {
            $data['photo'] = $this->photo->store('photos', 'public');
        }

        if ($this->contact) {
            $this->contact->update($data);
            $contact = $this->contact;
        } else {
            $contact = Contact::create($data);
        }

        foreach ($this->documents as $i => $doc) {
            if ($doc) {
                $path = $doc->store('contact-documents', 'public');
                $contact->documents()->create([
                    'file_path' => $path,
                    'file_name' => $doc->getClientOriginalName(),
                    'file_type' => $doc->getMimeType(),
                    'notes' => $this->documentNotes[$i] ?? null,
                ]);
            }
        }

        $this->redirect(route('contacts'), navigate: true);
    }

    public function render()
    {
        return view('livewire.contacts.manage-form');
    }
}

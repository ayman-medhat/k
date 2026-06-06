<?php

namespace App\Livewire\Subjects;

use App\Models\Subject;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?Subject $subject = null;

    public $name = '';
    public $name_ar = '';
    public $description = '';
    public $parent_id = '';
    public $is_main = true;
    public $is_religion_based = false;
    public $religion = '';

    public function mount(?Subject $subject = null)
    {
        $this->subject = $subject;

        if ($subject) {
            $this->name = $subject->name;
            $this->name_ar = $subject->name_ar;
            $this->description = $subject->description;
            $this->parent_id = $subject->parent_id ?? '';
            $this->is_main = $subject->is_main;
            $this->is_religion_based = $subject->is_religion_based;
            $this->religion = $subject->religion ?? '';
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:subjects,id',
            'is_main' => 'boolean',
            'is_religion_based' => 'boolean',
            'religion' => 'nullable|string|in:Muslim,Christian',
        ];
    }

    #[Computed]
    public function parentSubjects()
    {
        return Subject::whereNull('parent_id')->orderBy('name')->get(['id', 'name', 'name_ar']);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'description' => $this->description,
            'parent_id' => $this->parent_id ?: null,
            'is_main' => $this->is_main,
            'is_religion_based' => $this->is_religion_based,
            'religion' => $this->is_religion_based ? $this->religion : null,
        ];

        if ($this->subject) {
            $this->subject->update($data);
        } else {
            Subject::create($data);
        }

        $this->redirect(route('subjects'), navigate: true);
    }

    public function render()
    {
        return view('livewire.subjects.manage-form');
    }
}

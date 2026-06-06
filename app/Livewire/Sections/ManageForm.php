<?php

namespace App\Livewire\Sections;

use App\Models\Grade;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?Section $section = null;

    public $grade_id = '';
    public $name = '';
    public $name_ar = '';

    public function mount(?Section $section = null)
    {
        $this->section = $section;

        if ($section) {
            $this->grade_id = $section->grade_id;
            $this->name = $section->name;
            $this->name_ar = $section->name_ar;
        }
    }

    public function rules()
    {
        return [
            'grade_id' => 'required|exists:grades,id',
            'name' => 'required|string|max:10',
            'name_ar' => 'required|string|max:10',
        ];
    }

    #[Computed]
    public function grades()
    {
        return Grade::orderBy('level_order')->get();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'grade_id' => $this->grade_id,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
        ];

        if ($this->section) {
            $this->section->update($data);
        } else {
            Section::create($data);
        }

        $this->redirect(route('sections'), navigate: true);
    }

    public function render()
    {
        return view('livewire.sections.manage-form');
    }
}

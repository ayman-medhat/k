<?php

namespace App\Livewire\Grades;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Subject;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?Grade $grade = null;

    public $name = '';
    public $name_ar = '';
    public $level_order = 0;
    public $description = '';
    public $num_classes = 0;
    public $assignedSubjectIds = [];

    public function mount(?Grade $grade = null)
    {
        $this->grade = $grade;

        if ($grade) {
            $this->name = $grade->name;
            $this->name_ar = $grade->name_ar;
            $this->level_order = $grade->level_order;
            $this->description = $grade->description;
            $this->num_classes = $grade->sections()->count();
            $this->assignedSubjectIds = $grade->subjects->pluck('id')->toArray();
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'level_order' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'num_classes' => 'nullable|integer|min:0|max:26',
            'assignedSubjectIds' => 'nullable|array',
            'assignedSubjectIds.*' => 'exists:subjects,id',
        ];
    }

    #[Computed]
    public function rootSubjects()
    {
        return Subject::with('children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'level_order' => $this->level_order,
            'description' => $this->description,
        ];

        if ($this->grade) {
            $this->grade->update($data);
            $this->grade->subjects()->sync($this->assignedSubjectIds);
            $this->grade->sections()->delete();
            Section::generateForGrade($this->grade->id, max(0, (int)$this->num_classes));
        } else {
            $grade = Grade::create($data);
            $grade->subjects()->sync($this->assignedSubjectIds);
            Section::generateForGrade($grade->id, max(0, (int)$this->num_classes));
        }

        $this->redirect(route('grades'), navigate: true);
    }

    public function render()
    {
        return view('livewire.grades.manage-form');
    }
}

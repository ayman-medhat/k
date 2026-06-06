<?php

namespace App\Livewire\Stages;

use App\Models\Grade;
use App\Models\Stage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?Stage $stage = null;

    public $name = '';
    public $name_ar = '';
    public $level_order = 0;
    public $description = '';
    public $selectedGradeIds = [];

    public function mount(?Stage $stage = null)
    {
        $this->stage = $stage;

        if ($stage) {
            $this->name = $stage->name;
            $this->name_ar = $stage->name_ar;
            $this->level_order = $stage->level_order;
            $this->description = $stage->description;
            $this->selectedGradeIds = $stage->grades->pluck('id')->toArray();
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'level_order' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'selectedGradeIds' => 'nullable|array',
            'selectedGradeIds.*' => 'exists:grades,id',
        ];
    }

    #[Computed]
    public function allGrades()
    {
        return Grade::orderBy('level_order')->orderBy('name')->get();
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

        if ($this->stage) {
            $this->stage->update($data);
            $this->stage->grades()->sync($this->selectedGradeIds);
        } else {
            $stage = Stage::create($data);
            $stage->grades()->sync($this->selectedGradeIds);
        }

        $this->redirect(route('stages'), navigate: true);
    }

    public function render()
    {
        return view('livewire.stages.manage-form');
    }
}

<?php

namespace App\Livewire\Sections;

use App\Models\Grade;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class Manage extends Component
{
    public $viewMode = 'list';
    public $filterGradeId = '';

    // Bulk generation
    public $showGenerateForm = false;
    public $generateGradeId = '';
    public $generateCount = 1;

    #[Computed]
    public function grades()
    {
        return Grade::orderBy('level_order')->get();
    }

    public function sections()
    {
        return Section::with('grade')
            ->when($this->filterGradeId !== '', fn($q) => $q->where('grade_id', $this->filterGradeId))
            ->orderBy('grade_id')
            ->orderBy('name')
            ->get();
    }

    public function delete($id)
    {
        Section::findOrFail($id)->delete();
    }

    public function openGenerate()
    {
        $this->reset('generateGradeId', 'generateCount');
        $this->generateCount = 1;
        $this->showGenerateForm = true;
    }

    public function generate()
    {
        $this->validate([
            'generateGradeId' => 'required|exists:grades,id',
            'generateCount' => 'required|integer|min:1|max:26',
        ]);

        Section::generateForGrade($this->generateGradeId, $this->generateCount);

        $this->showGenerateForm = false;
        $this->reset('generateGradeId', 'generateCount');
    }

    public function render()
    {
        return view('livewire.sections.manage', [
            'sections' => $this->sections(),
        ]);
    }
}

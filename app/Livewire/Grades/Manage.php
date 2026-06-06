<?php

namespace App\Livewire\Grades;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Stage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class Manage extends Component
{
    public $viewMode = 'list';
    public $selectedStageId = '';

    protected static $classesEnsured = false;

    public function boot()
    {
        if (static::$classesEnsured) return;
        static::$classesEnsured = true;

        Grade::doesntHave('sections')
            ->chunk(50, fn ($grades) => $grades->each(fn ($g) => Section::generateForGrade($g->id, 2)));
    }

    public function delete($id)
    {
        Grade::findOrFail($id)->delete();
    }

    public function filterByStage($stageId)
    {
        $this->selectedStageId = $stageId;
    }

    #[Computed]
    public function allStages()
    {
        return Stage::orderBy('level_order')->get();
    }

    public function render()
    {
        $gradeQuery = fn($q) => $q->withCount('sections', 'subjects')->orderBy('level_order');

        $stagesQuery = Stage::with(['grades' => $gradeQuery])->orderBy('level_order');

        if ($this->selectedStageId !== '') {
            $stagesQuery->where('id', $this->selectedStageId);
        }

        $unassigned = collect();
        if ($this->selectedStageId === '') {
            $unassigned = Grade::withCount('sections', 'subjects')
                ->whereDoesntHave('stages')
                ->orderBy('level_order')
                ->get();
        }

        return view('livewire.grades.manage', [
            'stages' => $stagesQuery->get(),
            'unassigned' => $unassigned,
        ]);
    }
}

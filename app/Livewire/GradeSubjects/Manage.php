<?php

namespace App\Livewire\GradeSubjects;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout("layouts.app")]
class Manage extends Component
{
    public $selectedGradeId = null;
    public $assignedSubjectIds = [];

    public function selectGrade($gradeId)
    {
        $this->selectedGradeId = $gradeId;
        $grade = Grade::find($gradeId);
        $this->assignedSubjectIds = $grade ? $grade->subjects->pluck("id")->toArray() : [];
    }

    public function toggleSubject($subjectId)
    {
        if (! $this->selectedGradeId) return;

        $grade = Grade::findOrFail($this->selectedGradeId);

        if (in_array($subjectId, $this->assignedSubjectIds)) {
            $grade->subjects()->detach($subjectId);
            $this->assignedSubjectIds = array_diff($this->assignedSubjectIds, [$subjectId]);
        } else {
            $grade->subjects()->attach($subjectId);
            $this->assignedSubjectIds[] = $subjectId;
        }

    }

    #[Computed]
    public function grades()
    {
        return Grade::orderBy("level_order")->get(["id", "name", "name_ar"]);
    }

    #[Computed]
    public function rootSubjects()
    {
        return Subject::with("children")
            ->whereNull("parent_id")
            ->orderBy("name")
            ->get();
    }

    public function render()
    {
        return view("livewire.grade-subjects.manage");
    }
}

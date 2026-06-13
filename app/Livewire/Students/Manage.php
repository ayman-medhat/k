<?php

namespace App\Livewire\Students;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Manage extends Component
{
    use WithPagination;

    public $search = '';
    public $grade_id = '';
    public $section_id = '';

    public function delete($id)
    {
        Student::findOrFail($id)->delete();
    }

    public function updateSection($studentId, $sectionId)
    {
        Student::findOrFail($studentId)->update(['section_id' => $sectionId ?: null]);
    }

    public function updatedGradeId()
    {
        $this->section_id = '';
    }

    #[Computed]
    public function grades()
    {
        return Grade::orderBy('level_order')->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function sections()
    {
        if (!$this->grade_id) return collect();
        return Section::where('grade_id', $this->grade_id)
            ->orderBy('name')
            ->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function allSections()
    {
        return Section::with('grade')->orderBy('grade_id')->orderBy('name')->get();
    }

    public function render()
    {
        $user = auth()->user();
        if ($user->role === 'parent') {
            $this->redirect(route('parent.dashboard'), navigate: true);
            return;
        }

        $query = Student::with(['contact', 'grade', 'section'])
            ->orderBy('id', 'desc');

        if ($this->search) {
            $query->whereHas('contact', function ($q) {
                $q->where('nameEn', 'like', "%{$this->search}%")
                  ->orWhere('nameAr', 'like', "%{$this->search}%");
            });
        }

        if ($this->grade_id) {
            $query->where('grade_id', $this->grade_id);
        }

        if ($this->section_id) {
            $query->where('section_id', $this->section_id);
        }

        return view('livewire.students.manage', [
            'students' => $query->paginate(20),
            'isControl' => auth()->user()->isControl(),
        ]);
    }
}

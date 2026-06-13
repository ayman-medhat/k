<?php

namespace App\Livewire\Enrollments;

use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Manage extends Component
{
    use WithPagination;

    public $search = '';
    public $academic_year_id = '';
    public $grade_id = '';
    public $status = '';

    public function mount()
    {
        if (auth()->user()->role === 'parent') {
            $this->redirect(route('parent.dashboard'), navigate: true);
            return;
        }

        $currentYear = AcademicYear::where('is_current', true)->first();
        if ($currentYear) {
            $this->academic_year_id = (string) $currentYear->id;
        }
    }

    public function delete($id)
    {
        Enrollment::findOrFail($id)->delete();
    }

    #[Computed]
    public function academicYears()
    {
        return AcademicYear::orderBy('start_date', 'desc')->get(['id', 'name']);
    }

    #[Computed]
    public function grades()
    {
        return Grade::orderBy('level_order')->get(['id', 'name']);
    }

    public function render()
    {
        $query = Enrollment::with(['student.contact', 'academicYear', 'grade', 'section'])
            ->orderBy('created_at', 'desc');

        if ($this->academic_year_id) {
            $query->where('academic_year_id', $this->academic_year_id);
        }

        if ($this->grade_id) {
            $query->where('grade_id', $this->grade_id);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->search) {
            $query->whereHas('student.contact', function ($q) {
                $q->where('nameEn', 'like', "%{$this->search}%")
                  ->orWhere('nameAr', 'like', "%{$this->search}%");
            });
        }

        return view('livewire.enrollments.manage', [
            'enrollments' => $query->paginate(20),
        ]);
    }
}

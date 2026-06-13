<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
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

    public $section_id = '';
    public $grade_id = '';
    public $status_filter = '';
    public $date_from = '';
    public $date_to = '';

    public function delete($id)
    {
        Attendance::findOrFail($id)->delete();
    }

    #[Computed]
    public function grades()
    {
        return Grade::orderBy('level_order')->get(['id', 'name']);
    }

    #[Computed]
    public function sections()
    {
        if (!$this->grade_id) return collect();
        return Section::where('grade_id', $this->grade_id)->orderBy('name')->get(['id', 'name', 'name_ar']);
    }

    public function updatedGradeId()
    {
        $this->section_id = '';
    }

    public function render()
    {
        if (auth()->user()->role === 'parent') {
            $this->redirect(route('parent.dashboard'), navigate: true);
            return;
        }

        $query = Attendance::with(['student.contact', 'section.grade'])
            ->orderBy('date', 'desc')
            ->orderBy(Attendance::select('nameEn')
                ->whereColumn('students.id', 'attendance.student_id')
                ->from('students')
                ->join('contacts', 'students.contact_id', '=', 'contacts.id')
                ->take(1)
            );

        if ($this->section_id) {
            $query->where('section_id', $this->section_id);
        }

        if ($this->status_filter) {
            $query->where('status', $this->status_filter);
        }

        if ($this->date_from) {
            $query->whereDate('date', '>=', $this->date_from);
        }

        if ($this->date_to) {
            $query->whereDate('date', '<=', $this->date_to);
        }

        return view('livewire.attendance.manage', [
            'records' => $query->paginate(30),
        ]);
    }
}

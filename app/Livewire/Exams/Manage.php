<?php

namespace App\Livewire\Exams;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\Term;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class Manage extends Component
{
    public $grade_id = '';
    public $term_id = '';

    public function delete($id)
    {
        Exam::findOrFail($id)->delete();
    }

    #[Computed]
    public function grades()
    {
        return Grade::orderBy('level_order')->get(['id', 'name']);
    }

    #[Computed]
    public function terms()
    {
        return Term::with('academicYear')->orderBy('start_date')->get();
    }

    public function render()
    {
        if (auth()->user()->role === 'parent') {
            $this->redirect(route('parent.dashboard'), navigate: true);
            return;
        }

        $query = Exam::with(['grade', 'term.academicYear', 'subjects', 'records'])
            ->orderBy('date', 'desc');

        if ($this->grade_id) {
            $query->where('grade_id', $this->grade_id);
        }

        if ($this->term_id) {
            $query->where('term_id', $this->term_id);
        }

        return view('livewire.exams.manage', [
            'exams' => $query->get(),
        ]);
    }
}

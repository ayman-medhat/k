<?php

namespace App\Livewire\Terms;

use App\Models\AcademicYear;
use App\Models\Term;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class Manage extends Component
{
    public $academic_year_id = '';

    public function mount()
    {
        $currentYear = AcademicYear::where('is_current', true)->first();
        if ($currentYear) {
            $this->academic_year_id = (string) $currentYear->id;
        }
    }

    public function setCurrent($id)
    {
        Term::where('academic_year_id', $this->academic_year_id)->update(['is_current' => false]);
        Term::findOrFail($id)->update(['is_current' => true]);
    }

    public function delete($id)
    {
        Term::findOrFail($id)->delete();
    }

    #[Computed]
    public function academicYears()
    {
        return AcademicYear::orderBy('start_date', 'desc')->get(['id', 'name']);
    }

    public function render()
    {
        $query = Term::with('academicYear')->orderBy('start_date');

        if ($this->academic_year_id) {
            $query->where('academic_year_id', $this->academic_year_id);
        }

        return view('livewire.terms.manage', [
            'terms' => $query->get(),
        ]);
    }
}

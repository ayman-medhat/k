<?php

namespace App\Livewire\Terms;

use App\Models\AcademicYear;
use App\Models\Term;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?Term $term = null;

    public $academic_year_id = '';
    public $name = '';
    public $start_date = '';
    public $end_date = '';
    public $is_current = false;

    public function mount(?Term $term = null)
    {
        $this->term = $term;

        if ($term) {
            $this->academic_year_id = (string) $term->academic_year_id;
            $this->name = $term->name;
            $this->start_date = $term->start_date->format('Y-m-d');
            $this->end_date = $term->end_date->format('Y-m-d');
            $this->is_current = $term->is_current;
        } else {
            $currentYear = AcademicYear::where('is_current', true)->first();
            if ($currentYear) {
                $this->academic_year_id = (string) $currentYear->id;
            }
        }
    }

    public function rules()
    {
        return [
            'academic_year_id' => 'required|exists:academic_years,id',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_current' => 'boolean',
        ];
    }

    #[Computed]
    public function academicYears()
    {
        return AcademicYear::orderBy('start_date', 'desc')->get(['id', 'name']);
    }

    public function save()
    {
        $this->validate();

        if ($this->is_current) {
            Term::where('academic_year_id', $this->academic_year_id)
                ->where('id', '!=', $this->term?->id)
                ->update(['is_current' => false]);
        }

        $data = [
            'academic_year_id' => $this->academic_year_id,
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_current' => $this->is_current,
        ];

        if ($this->term) {
            $this->term->update($data);
        } else {
            Term::create($data);
        }

        $this->redirect(route('terms'), navigate: true);
    }

    public function render()
    {
        return view('livewire.terms.manage-form');
    }
}

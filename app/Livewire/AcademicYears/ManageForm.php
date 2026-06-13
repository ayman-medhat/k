<?php

namespace App\Livewire\AcademicYears;

use App\Models\AcademicYear;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?AcademicYear $academicYear = null;

    public $name = '';
    public $start_date = '';
    public $end_date = '';
    public $is_current = false;

    public function mount(?AcademicYear $academicYear = null)
    {
        $this->academicYear = $academicYear;

        if ($academicYear) {
            $this->name = $academicYear->name;
            $this->start_date = $academicYear->start_date->format('Y-m-d');
            $this->end_date = $academicYear->end_date->format('Y-m-d');
            $this->is_current = $academicYear->is_current;
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_current' => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->is_current) {
            AcademicYear::where('id', '!=', $this->academicYear?->id)->update(['is_current' => false]);
        }

        $data = [
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_current' => $this->is_current,
        ];

        if ($this->academicYear) {
            $this->academicYear->update($data);
        } else {
            AcademicYear::create($data);
        }

        $this->redirect(route('academic-years'), navigate: true);
    }

    public function render()
    {
        return view('livewire.academic-years.manage-form');
    }
}

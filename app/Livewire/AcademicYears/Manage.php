<?php

namespace App\Livewire\AcademicYears;

use App\Models\AcademicYear;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Manage extends Component
{
    public function setCurrent($id)
    {
        AcademicYear::query()->update(['is_current' => false]);
        AcademicYear::findOrFail($id)->update(['is_current' => true]);
    }

    public function delete($id)
    {
        AcademicYear::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.academic-years.manage', [
            'academicYears' => AcademicYear::orderBy('start_date', 'desc')->get(),
        ]);
    }
}

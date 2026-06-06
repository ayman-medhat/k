<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Manage extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        Student::findOrFail($id)->delete();
    }

    public function render()
    {
        $query = Student::with(['contact', 'grade', 'section'])
            ->orderBy('id', 'desc');

        if ($this->search) {
            $query->whereHas('contact', function ($q) {
                $q->where('nameEn', 'like', "%{$this->search}%")
                  ->orWhere('nameAr', 'like', "%{$this->search}%");
            });
        }

        return view('livewire.students.manage', [
            'students' => $query->paginate(20),
            'isControl' => auth()->user()->isControl(),
        ]);
    }
}

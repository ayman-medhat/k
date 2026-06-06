<?php

namespace App\Livewire\Subjects;

use App\Models\Subject;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Manage extends Component
{
    public $viewMode = 'list';

    public function delete($id)
    {
        Subject::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.subjects.manage', [
            'subjects' => Subject::with('parent', 'children')
                ->orderBy('parent_id')
                ->orderBy('name')
                ->get(),
        ]);
    }
}

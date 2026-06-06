<?php

namespace App\Livewire\Stages;

use App\Models\Stage;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Manage extends Component
{
    public $viewMode = 'list';

    public function delete($id)
    {
        Stage::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.stages.manage', [
            'stages' => Stage::withCount('grades')->orderBy('level_order')->get(),
        ]);
    }
}

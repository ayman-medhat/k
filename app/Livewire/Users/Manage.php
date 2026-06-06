<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Manage extends Component
{
    use WithPagination;

    public function mount()
    {
        $user = auth()->user();
        abort_if(!$user->isAdmin(), 403);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            session()->flash('error', 'You cannot delete yourself.');
            return;
        }

        $user->delete();
    }

    public function render()
    {
        return view('livewire.users.manage', [
            'users' => User::orderBy('name')->paginate(20),
        ]);
    }
}

<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?User $user = null;

    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = 'admin';

    public function mount(?User $user = null)
    {
        abort_if(!auth()->user()->isAdmin(), 403);

        $this->user = $user;

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
        }
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($this->user?->id ? ',' . $this->user->id : ''),
            'role' => 'required|string|in:admin,hr,student_affairs,academic,control',
        ];

        if ($this->user) {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        } else {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->user && $this->user->id === auth()->id()) {
            $data['role'] = 'admin';
        } else {
            $data['role'] = $this->role;
        }

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        if ($this->user) {
            $this->user->update($data);
        } else {
            $data['role'] = $this->role;
            User::create($data);
        }

        $this->redirect(route('users'), navigate: true);
    }

    public function render()
    {
        return view('livewire.users.manage-form');
    }
}

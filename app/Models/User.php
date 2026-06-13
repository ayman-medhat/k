<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'role', 'lead_id', 'locale'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    public function isAdmin(): bool
    {
        return $this->role === null || $this->role === 'admin';
    }

    public function isHr(): bool
    {
        return $this->role === 'hr';
    }

    public function isStudentAffairs(): bool
    {
        return $this->role === 'student_affairs';
    }

    public function isAcademic(): bool
    {
        return $this->role === 'academic';
    }

    public function isControl(): bool
    {
        return $this->role === 'control';
    }

    // ----------------------------------------------------------
    // Parent role check — used to filter leads view, gate CRUD pages
    // ----------------------------------------------------------
    public function isParent(): bool
    {
        return $this->role === 'parent';
    }

    // ----------------------------------------------------------
    // Student role check — for LMS preparation
    // ----------------------------------------------------------
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    // ----------------------------------------------------------
    // Link the user account to a Lead record (parent lead_id FK)
    // Used by parent dashboard and ensureUserForLead()
    // ----------------------------------------------------------
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

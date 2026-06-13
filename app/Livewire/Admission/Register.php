<?php
// ============================================================
// Parent Self-Registration Component
// Public-facing registration form at /admission/register
// Creates a Parent Lead + User with role=parent, then auto-logs in
// ============================================================

namespace App\Livewire\Admission;

use App\Models\Lead;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Register extends Component
{
    // Step 1 = form, Step 2 = success screen
    public $step = 1;

    // Parent's personal information
    public $nameEn = '';
    public $nameAr = '';
    public $email = '';
    public $phone = '';
    public $nationality = 'Egyptian';
    public $religion = '';
    public $gender = '';
    public $national_id = '';

    // Account credentials
    public $password = '';
    public $password_confirmation = '';

    public function rules()
    {
        return [
            'nameEn' => ['required', 'string', 'max:255'],
            'nameAr' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['nullable', 'string', 'max:20'],
            'nationality' => ['required', 'string', 'max:100'],
            'religion' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'string', 'in:Male,Female'],
            'national_id' => ['nullable', 'string', 'size:14', 'unique:' . Lead::class . ',national_id'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ];
    }

    // ----------------------------------------------------------
    // Submit registration: create Lead + User, login, show success
    // ----------------------------------------------------------
    public function submit()
    {
        $this->validate();

        // Create the Parent Lead (the model's booted saving event
        // auto-extracts birth_date from national_id when Egyptian)
        $lead = Lead::create([
            'nameEn' => $this->nameEn,
            'nameAr' => $this->nameAr,
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality,
            'religion' => $this->religion,
            'gender' => $this->gender,
            'national_id' => $this->nationality === 'Egyptian' ? $this->national_id : null,
            'categories' => ['Parent'],
            'status' => 'New',
            'source' => 'Parent Registration',
        ]);

        // Create the User account linked to the Lead via lead_id
        $user = User::create([
            'name' => $this->nameEn,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'parent',
            'lead_id' => $lead->id,
        ]);

        // Auto-login the new parent
        Auth::login($user);

        $this->step = 2;
    }

    // ----------------------------------------------------------
    // Render with live stats for the scrolling marquee
    // ----------------------------------------------------------
    public function render()
    {
        $school = School::first();
        $establishedYear = $school?->established_year ?? now()->year;
        $stats = [
            'students' => Student::count(),
            'teachers' => User::whereIn('role', ['teacher', 'admin', 'hr'])->count(),
            'years' => now()->year - $establishedYear,
        ];

        return view('livewire.admission.register', ['stats' => $stats]);
    }
}

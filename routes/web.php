<?php

use App\Models\Grade;
use App\Models\Lead;
use App\Models\School;
use App\Models\Section;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\SchoolLandingController::class, 'index']);

Route::get('dashboard', function () {
    return view('dashboard', [
        'stats' => [
            ['label' => 'Leads', 'count' => Lead::count(), 'icon' => '👥', 'route' => 'leads'],
            ['label' => 'Contacts', 'count' => Contact::count(), 'icon' => '👤', 'route' => 'contacts'],
            ['label' => 'Grades', 'count' => Grade::count(), 'icon' => '🎓', 'route' => 'grades'],
            ['label' => 'Classes', 'count' => Section::count(), 'icon' => '🏫', 'route' => 'sections'],
            ['label' => 'Subjects', 'count' => Subject::count(), 'icon' => '📚', 'route' => 'subjects'],
            ['label' => 'Stages', 'count' => Stage::count(), 'icon' => '🗂️', 'route' => 'stages'],
            ['label' => 'School', 'count' => School::count(), 'icon' => '🏫', 'route' => 'schools'],
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('leads', \App\Livewire\Leads\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('leads');
Route::get('leads/create', \App\Livewire\Leads\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('leads.create');
Route::get('leads/{lead}/edit', \App\Livewire\Leads\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('leads.edit');

Route::get('contacts', \App\Livewire\Contacts\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('contacts');
Route::get('contacts/create', \App\Livewire\Contacts\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('contacts.create');
Route::get('contacts/{contact}/edit', \App\Livewire\Contacts\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('contacts.edit');

Route::get('grades', \App\Livewire\Grades\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('grades');
Route::get('grades/create', \App\Livewire\Grades\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('grades.create');
Route::get('grades/{grade}/edit', \App\Livewire\Grades\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('grades.edit');

Route::get('subjects', \App\Livewire\Subjects\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('subjects');
Route::get('subjects/create', \App\Livewire\Subjects\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('subjects.create');
Route::get('subjects/{subject}/edit', \App\Livewire\Subjects\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('subjects.edit');

Route::get('sections', \App\Livewire\Sections\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('sections');
Route::get('sections/create', \App\Livewire\Sections\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('sections.create');
Route::get('sections/{section}/edit', \App\Livewire\Sections\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('sections.edit');

Route::get('grade-subjects', \App\Livewire\GradeSubjects\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('grade-subjects');

Route::get('stages', \App\Livewire\Stages\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('stages');
Route::get('stages/create', \App\Livewire\Stages\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('stages.create');
Route::get('stages/{stage}/edit', \App\Livewire\Stages\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('stages.edit');

Route::get('students', \App\Livewire\Students\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('students');
Route::get('students/create', \App\Livewire\Students\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('students.create');
Route::get('students/{student}/edit', \App\Livewire\Students\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('students.edit');

Route::get('schools', \App\Livewire\Schools\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('schools');

Route::get('users', \App\Livewire\Users\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('users');
Route::get('users/create', \App\Livewire\Users\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('users.create');
Route::get('users/{user}/edit', \App\Livewire\Users\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('users.edit');

require __DIR__.'/auth.php';

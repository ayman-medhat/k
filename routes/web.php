<?php

use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Lead;
use App\Models\School;
use App\Models\Section;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\Contact;
use App\Models\Term;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\SchoolLandingController::class, 'index']);

Route::get('language/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
        if (auth()->user()) {
            auth()->user()->update(['locale' => $locale]);
        }
    }
    return redirect()->back();
})->name('language.switch');

Route::get('dashboard', function () {
    return view('dashboard', [
        'stats' => [
            ['label' => __('nav.leads'), 'count' => Lead::count(), 'icon' => '👥', 'route' => 'leads'],
            ['label' => __('nav.contacts'), 'count' => Contact::count(), 'icon' => '👤', 'route' => 'contacts'],
            ['label' => __('nav.grades'), 'count' => Grade::count(), 'icon' => '🎓', 'route' => 'grades'],
            ['label' => __('nav.classes'), 'count' => Section::count(), 'icon' => '🏫', 'route' => 'sections'],
            ['label' => __('nav.subjects'), 'count' => Subject::count(), 'icon' => '📚', 'route' => 'subjects'],
            ['label' => __('nav.stages'), 'count' => Stage::count(), 'icon' => '🗂️', 'route' => 'stages'],
            ['label' => __('nav.attendance'), 'count' => Attendance::count(), 'icon' => '📋', 'route' => 'attendance'],
            ['label' => __('nav.academic_years'), 'count' => AcademicYear::count(), 'icon' => '📅', 'route' => 'academic-years'],
            ['label' => __('nav.terms'), 'count' => Term::count(), 'icon' => '📆', 'route' => 'terms'],
            ['label' => __('nav.enrollments'), 'count' => Enrollment::count(), 'icon' => '📋', 'route' => 'enrollments'],
            ['label' => __('nav.school'), 'count' => School::count(), 'icon' => '🏫', 'route' => 'schools'],
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
Route::get('leads/import', \App\Livewire\Leads\Import::class)
    ->middleware(['auth', 'verified'])
    ->name('leads.import');
Route::get('leads/import/template', function () {
    $columns = ['nameEn', 'nameAr', 'email', 'phone', 'nationality', 'religion', 'gender', 'categories', 'national_id', 'passport_no', 'birth_date', 'status', 'source', 'notes', 'grade_id', 'parent_national_id', 'mother_national_id'];
    $example = ['John Doe', 'جون دو', 'john@example.com', '01234567890', 'Egyptian', 'Muslim', 'Male', 'Student,Parent', '12345678901234', '', '2012-01-15', 'New', 'School Fair', '', '1', '', ''];
    return response()->streamDownload(function () use ($columns, $example) {
        $f = fopen('php://output', 'w');
        fwrite($f, "\xEF\xBB\xBF");
        fputcsv($f, $columns);
        fputcsv($f, $example);
        fclose($f);
    }, 'leads-import-template.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
})->middleware(['auth', 'verified'])->name('leads.import.template');

Route::get('leads/export', function () {
    $leads = \App\Models\Lead::with('parent', 'mother', 'grade')
        ->orderBy('nameEn')
        ->get();

    $filename = 'leads-' . now()->format('Y-m-d') . '.xlsx';

    return response()->stream(function () use ($leads) {
        $writer = new \OpenSpout\Writer\XLSX\Writer;
        $writer->openToFile('php://output');

        $headerRow = \OpenSpout\Common\Entity\Row::fromValues([
            'Name (EN)', 'Name (AR)', 'Email', 'Phone',
            'Nationality', 'Religion', 'Gender', 'Categories',
            'National ID', 'Passport No', 'Birth Date',
            'Status', 'Source', 'Notes',
            'Parent Name', 'Mother Name', 'Grade',
        ]);
        $writer->addRow($headerRow);

        foreach ($leads as $lead) {
            $row = \OpenSpout\Common\Entity\Row::fromValues([
                $lead->nameEn,
                $lead->nameAr,
                $lead->email,
                $lead->phone,
                $lead->nationality,
                $lead->religion,
                $lead->gender,
                is_array($lead->categories) ? implode(', ', $lead->categories) : $lead->categories,
                $lead->national_id,
                $lead->passport_no,
                $lead->birth_date?->format('Y-m-d'),
                $lead->status,
                $lead->source,
                $lead->notes,
                $lead->parent ? ($lead->parent->nameEn . ' / ' . $lead->parent->nameAr) : '',
                $lead->mother ? ($lead->mother->nameEn . ' / ' . $lead->mother->nameAr) : '',
                $lead->grade?->name ?? '',
            ]);
            $writer->addRow($row);
        }

        $writer->close();
    }, 200, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
})->middleware(['auth', 'verified'])->name('leads.export');

Route::get('contacts', \App\Livewire\Contacts\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('contacts');
Route::get('contacts/create', \App\Livewire\Contacts\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('contacts.create');
Route::get('contacts/{contact}/edit', \App\Livewire\Contacts\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('contacts.edit');
Route::get('contacts/import', \App\Livewire\Contacts\Import::class)
    ->middleware(['auth', 'verified'])
    ->name('contacts.import');
Route::get('contacts/import/template', function () {
    $columns = ['nameEn', 'nameAr', 'email', 'phone', 'nationality', 'religion', 'gender', 'categories', 'national_id', 'passport_no', 'birth_date', 'status', 'source', 'notes', 'parent_national_id', 'mother_national_id'];
    $example = ['Jane Doe', 'جين دو', 'jane@example.com', '01234567891', 'Egyptian', 'Muslim', 'Female', 'Parent', '22345678901234', '', '1985-06-20', 'Active', 'Referral', '', '', ''];
    return response()->streamDownload(function () use ($columns, $example) {
        $f = fopen('php://output', 'w');
        fwrite($f, "\xEF\xBB\xBF");
        fputcsv($f, $columns);
        fputcsv($f, $example);
        fclose($f);
    }, 'contacts-import-template.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
})->middleware(['auth', 'verified'])->name('contacts.import.template');

Route::get('contacts/export', function () {
    $contacts = \App\Models\Contact::with('parent', 'mother', 'student.grade')
        ->orderBy('nameEn')
        ->get();

    $filename = 'contacts-' . now()->format('Y-m-d') . '.xlsx';

    return response()->stream(function () use ($contacts) {
        $writer = new \OpenSpout\Writer\XLSX\Writer;
        $writer->openToFile('php://output');

        $headerRow = \OpenSpout\Common\Entity\Row::fromValues([
            'Name (EN)', 'Name (AR)', 'Email', 'Phone',
            'Nationality', 'Religion', 'Gender', 'Categories',
            'National ID', 'Passport No', 'Birth Date',
            'Status', 'Source', 'Notes',
            'Parent Name', 'Mother Name', 'Grade',
        ]);
        $writer->addRow($headerRow);

        foreach ($contacts as $contact) {
            $row = \OpenSpout\Common\Entity\Row::fromValues([
                $contact->nameEn,
                $contact->nameAr,
                $contact->email,
                $contact->phone,
                $contact->nationality,
                $contact->religion,
                $contact->gender,
                is_array($contact->categories) ? implode(', ', $contact->categories) : $contact->categories,
                $contact->national_id,
                $contact->passport_no,
                $contact->birth_date?->format('Y-m-d'),
                $contact->status,
                $contact->source,
                $contact->notes,
                $contact->parent ? ($contact->parent->nameEn . ' / ' . $contact->parent->nameAr) : '',
                $contact->mother ? ($contact->mother->nameEn . ' / ' . $contact->mother->nameAr) : '',
                $contact->student?->grade?->name ?? '',
            ]);
            $writer->addRow($row);
        }

        $writer->close();
    }, 200, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
})->middleware(['auth', 'verified'])->name('contacts.export');

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

Route::get('academic-years', \App\Livewire\AcademicYears\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('academic-years');
Route::get('academic-years/create', \App\Livewire\AcademicYears\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('academic-years.create');
Route::get('academic-years/{academicYear}/edit', \App\Livewire\AcademicYears\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('academic-years.edit');

Route::get('terms', \App\Livewire\Terms\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('terms');
Route::get('terms/create', \App\Livewire\Terms\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('terms.create');
Route::get('terms/{term}/edit', \App\Livewire\Terms\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('terms.edit');

Route::get('enrollments', \App\Livewire\Enrollments\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('enrollments');
Route::get('enrollments/create', \App\Livewire\Enrollments\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('enrollments.create');
Route::get('enrollments/{enrollment}/edit', \App\Livewire\Enrollments\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('enrollments.edit');

Route::get('attendance', \App\Livewire\Attendance\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('attendance');
Route::get('attendance/take', \App\Livewire\Attendance\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('attendance.take');

Route::get('exams', \App\Livewire\Exams\Manage::class)
    ->middleware(['auth', 'verified'])
    ->name('exams');
Route::get('exams/create', \App\Livewire\Exams\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('exams.create');
Route::get('exams/{exam}/edit', \App\Livewire\Exams\ManageForm::class)
    ->middleware(['auth', 'verified'])
    ->name('exams.edit');
Route::get('exams/{exam}/marks', \App\Livewire\Exams\MarksEntry::class)
    ->middleware(['auth', 'verified'])
    ->name('exams.marks');
Route::get('student-degrees', \App\Livewire\Exams\StudentDegrees::class)
    ->middleware(['auth', 'verified'])
    ->name('student-degrees');
Route::get('student-degrees/pdf', [\App\Http\Controllers\StudentDegreesExportController::class, 'pdf'])
    ->middleware(['auth', 'verified'])
    ->name('student-degrees.pdf');
Route::get('student-degrees/excel', [\App\Http\Controllers\StudentDegreesExportController::class, 'excel'])
    ->middleware(['auth', 'verified'])
    ->name('student-degrees.excel');

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

Route::get('admission/register', \App\Livewire\Admission\Register::class)
    ->middleware('guest')
    ->name('admission.register');

Route::get('parent', \App\Livewire\Parent\Dashboard::class)
    ->middleware(['auth'])
    ->name('parent.dashboard');

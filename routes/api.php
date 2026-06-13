<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\StageController;
use App\Http\Controllers\Api\GradeSubjectController;
use App\Http\Controllers\Api\AcademicYearController;
use App\Http\Controllers\Api\TermController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExamRecordController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::apiResource('leads', LeadController::class);
    Route::post('leads/{lead}/accept', [LeadController::class, 'accept']);

    Route::apiResource('contacts', ContactController::class);
    Route::post('contacts/{contact}/restore', [ContactController::class, 'restore']);

    Route::apiResource('students', StudentController::class);

    Route::apiResource('grades', GradeController::class);

    Route::apiResource('subjects', SubjectController::class);

    Route::apiResource('sections', SectionController::class);
    Route::post('sections/generate', [SectionController::class, 'generate']);

    Route::apiResource('stages', StageController::class);

    Route::get('grade-subjects', [GradeSubjectController::class, 'index']);
    Route::post('grade-subjects/assign', [GradeSubjectController::class, 'assign']);
    Route::post('grade-subjects/remove', [GradeSubjectController::class, 'remove']);

    Route::apiResource('academic-years', AcademicYearController::class);
    Route::post('academic-years/{academicYear}/set-current', [AcademicYearController::class, 'setCurrent']);

    Route::apiResource('terms', TermController::class);
    Route::post('terms/{term}/set-current', [TermController::class, 'setCurrent']);

    Route::apiResource('enrollments', EnrollmentController::class);

    Route::get('attendance', [AttendanceController::class, 'index']);
    Route::post('attendance/take', [AttendanceController::class, 'take']);

    Route::apiResource('exams', ExamController::class);
    Route::get('exams/{exam}/marks', [ExamController::class, 'marks']);
    Route::post('exams/{exam}/marks', [ExamRecordController::class, 'store']);

    Route::get('school', [SchoolController::class, 'show']);
    Route::put('school', [SchoolController::class, 'update']);

    Route::apiResource('users', UserController::class)->middleware('ability:admin');
});

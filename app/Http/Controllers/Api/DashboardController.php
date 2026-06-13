<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Lead;
use App\Models\Section;
use App\Models\Stage;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'stats' => [
                'leads' => Lead::count(),
                'contacts' => Contact::count(),
                'students' => Student::count(),
                'grades' => Grade::count(),
                'sections' => Section::count(),
                'subjects' => Subject::count(),
                'stages' => Stage::count(),
                'academic_years' => AcademicYear::count(),
                'terms' => Term::count(),
                'enrollments' => Enrollment::count(),
            ],
        ]);
    }
}

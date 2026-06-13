<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Attendance::with(['student.contact', 'section.grade'])
            ->orderBy('date', 'desc');

        if ($request->section_id) {
            $query->where('section_id', $request->section_id);
        }

        if ($request->grade_id) {
            $query->whereHas('section', fn($q) => $q->where('grade_id', $request->grade_id));
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->date_from) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        return response()->json([
            'data' => $query->paginate($request->per_page ?? 30),
        ]);
    }

    public function take(Request $request): JsonResponse
    {
        $data = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
            'records' => 'required|array',
            'records.*.student_id' => 'required|exists:students,id',
            'records.*.status' => 'required|in:present,absent,late,excused',
            'records.*.notes' => 'nullable|string|max:500',
        ]);

        $userId = $request->user()->id;

        foreach ($data['records'] as $record) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $record['student_id'],
                    'section_id' => $data['section_id'],
                    'date' => $data['date'],
                ],
                [
                    'status' => $record['status'],
                    'notes' => $record['notes'] ?? null,
                    'created_by' => $userId,
                ]
            );
        }

        return response()->json([
            'message' => 'Attendance saved successfully',
        ]);
    }

    public function students(Request $request): JsonResponse
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
        ]);

        $currentYear = AcademicYear::where('is_current', true)->first();
        if (!$currentYear) {
            return response()->json(['data' => []]);
        }

        $enrolledStudents = Enrollment::with('student.contact')
            ->where('academic_year_id', $currentYear->id)
            ->where('section_id', $request->section_id)
            ->where('status', 'active')
            ->get();

        $existingAttendance = Attendance::where('section_id', $request->section_id)
            ->whereDate('date', $request->date)
            ->get()
            ->keyBy('student_id');

        $records = $enrolledStudents->map(function ($enrollment) use ($existingAttendance) {
            $existing = $existingAttendance->get($enrollment->student_id);
            return [
                'student_id' => $enrollment->student_id,
                'student_name' => $enrollment->student->contact?->nameEn ?? 'N/A',
                'grade_name' => $enrollment->grade?->name,
                'status' => $existing?->status ?? 'present',
                'notes' => $existing?->notes ?? '',
                'attendance_id' => $existing?->id,
            ];
        });

        return response()->json(['data' => $records]);
    }
}

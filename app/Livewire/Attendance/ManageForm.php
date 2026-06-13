<?php

namespace App\Livewire\Attendance;

use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public $section_id = '';
    public $grade_id = '';
    public $date = '';

    public $records = [];

    public function mount()
    {
        if (auth()->user()->role === 'parent') {
            $this->redirect(route('parent.dashboard'), navigate: true);
            return;
        }

        $this->date = now()->format('Y-m-d');
    }

    public function rules()
    {
        return [
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
            'records.*.status' => 'required|in:present,absent,late,excused',
            'records.*.notes' => 'nullable|string|max:500',
        ];
    }

    #[Computed]
    public function grades()
    {
        return Grade::orderBy('level_order')->get(['id', 'name']);
    }

    #[Computed]
    public function sections()
    {
        if (!$this->grade_id) return collect();
        return Section::where('grade_id', $this->grade_id)->orderBy('name')->get(['id', 'name', 'name_ar']);
    }

    public function updatedGradeId()
    {
        $this->section_id = '';
        $this->records = [];
    }

    public function updatedSectionId()
    {
        $this->loadStudents();
    }

    public function updatedDate()
    {
        if ($this->section_id) {
            $this->loadStudents();
        }
    }

    protected function loadStudents()
    {
        if (!$this->section_id || !$this->date) {
            $this->records = [];
            return;
        }

        $currentYear = AcademicYear::where('is_current', true)->first();
        if (!$currentYear) {
            $this->records = [];
            return;
        }

        $enrolledStudents = Enrollment::with('student.contact')
            ->where('academic_year_id', $currentYear->id)
            ->where('section_id', $this->section_id)
            ->where('status', 'active')
            ->get();

        $existingAttendance = Attendance::where('section_id', $this->section_id)
            ->whereDate('date', $this->date)
            ->get()
            ->keyBy('student_id');

        $this->records = $enrolledStudents->map(function ($enrollment) use ($existingAttendance) {
            $existing = $existingAttendance->get($enrollment->student_id);
            return [
                'student_id' => $enrollment->student_id,
                'student_name' => $enrollment->student->contact?->nameEn ?? 'N/A',
                'status' => $existing?->status ?? 'present',
                'notes' => $existing?->notes ?? '',
                'attendance_id' => $existing?->id,
            ];
        })->toArray();
    }

    public function save()
    {
        $this->validate();

        $userId = auth()->id();

        foreach ($this->records as $record) {
            $data = [
                'student_id' => $record['student_id'],
                'section_id' => $this->section_id,
                'date' => $this->date,
                'status' => $record['status'],
                'notes' => $record['notes'] ?: null,
                'created_by' => $userId,
            ];

            if ($record['attendance_id']) {
                Attendance::findOrFail($record['attendance_id'])->update($data);
            } else {
                Attendance::create($data);
            }
        }

        $this->redirect(route('attendance'), navigate: true);
    }

    public function render()
    {
        return view('livewire.attendance.manage-form');
    }
}

<?php

namespace App\Livewire\Enrollments;

use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?Enrollment $enrollment = null;

    public $student_id = '';
    public $academic_year_id = '';
    public $grade_id = '';
    public $section_id = '';
    public $enrolled_at = '';
    public $status = 'active';

    public $selectedStudents = [];
    public $selectAll = false;

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        if ($this->selectAll) {
            $this->selectedStudents = $this->getStudentsByGradeAndSection()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedStudents = [];
        }
    }

    public function toggleStudent($id)
    {
        $id = (string) $id;
        $idx = array_search($id, $this->selectedStudents);
        if ($idx !== false) {
            unset($this->selectedStudents[$idx]);
            $this->selectedStudents = array_values($this->selectedStudents);
            $this->selectAll = false;
        } else {
            $this->selectedStudents[] = $id;
            $allIds = $this->getStudentsByGradeAndSection()->pluck('id')->map(fn($i) => (string) $i)->toArray();
            if (empty(array_diff($allIds, $this->selectedStudents))) {
                $this->selectAll = true;
            }
        }
    }

    public function mount(?Enrollment $enrollment = null)
    {
        if (auth()->user()->role === 'parent') {
            $this->redirect(route('parent.dashboard'), navigate: true);
            return;
        }

        $this->enrollment = $enrollment;

        if ($enrollment) {
            $this->student_id = (string) $enrollment->student_id;
            $this->academic_year_id = (string) $enrollment->academic_year_id;
            $this->grade_id = (string) $enrollment->grade_id;
            $this->section_id = (string) ($enrollment->section_id ?? '');
            $this->enrolled_at = $enrollment->enrolled_at->format('Y-m-d');
            $this->status = $enrollment->status;
        } else {
            $currentYear = AcademicYear::where('is_current', true)->first();
            if ($currentYear) {
                $this->academic_year_id = (string) $currentYear->id;
            }
            $this->enrolled_at = now()->format('Y-m-d');
        }
    }

    public function rules()
    {
        if ($this->enrollment) {
            return [
                'student_id' => 'required|exists:students,id',
                'academic_year_id' => 'required|exists:academic_years,id',
                'grade_id' => 'required|exists:grades,id',
                'section_id' => 'nullable|exists:sections,id',
                'enrolled_at' => 'required|date',
                'status' => 'required|in:active,transferred,graduated,dropped',
            ];
        }
        return [
            'academic_year_id' => 'required|exists:academic_years,id',
            'grade_id' => 'required|exists:grades,id',
            'section_id' => 'nullable|exists:sections,id',
            'enrolled_at' => 'required|date',
            'status' => 'required|in:active,transferred,graduated,dropped',
            'selectedStudents' => 'required|array|min:1',
            'selectedStudents.*' => 'exists:students,id',
        ];
    }

    #[Computed]
    public function academicYears()
    {
        return AcademicYear::orderBy('start_date', 'desc')->get(['id', 'name']);
    }

    #[Computed]
    public function availableStudents()
    {
        return Student::with('contact')
            ->get()
            ->sortBy(fn($s) => $s->contact?->nameEn ?? '')
            ->values();
    }

    #[Computed]
    public function grades()
    {
        return Grade::orderBy('level_order')->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function availableSections()
    {
        if (!$this->grade_id) return collect();

        return Section::where('grade_id', $this->grade_id)
            ->orderBy('name')
            ->get(['id', 'name', 'name_ar']);
    }

    public function getStudentsByGradeAndSection()
    {
        $query = Student::with('contact');

        if ($this->section_id) {
            $query->where('section_id', $this->section_id);
        }

        return $query->orderBy('id')->get();
    }

    public function updatedGradeId()
    {
        $this->section_id = '';
        $this->selectedStudents = [];
        $this->selectAll = false;
    }

    public function updatedSectionId()
    {
        $this->selectedStudents = [];
        $this->selectAll = false;
    }

    public function updatedSelectAll() {} // handled by toggleSelectAll

    public function save()
    {
        $this->validate();

        $data = [
            'academic_year_id' => $this->academic_year_id,
            'grade_id' => $this->grade_id,
            'section_id' => $this->section_id ?: null,
            'enrolled_at' => $this->enrolled_at,
            'status' => $this->status,
        ];

        if ($this->enrollment) {
            $data['student_id'] = $this->student_id;
            $this->enrollment->update($data);
        } else {
            foreach ($this->selectedStudents as $sid) {
                Enrollment::create(array_merge($data, ['student_id' => $sid]));
            }
        }

        $this->redirect(route('enrollments'), navigate: true);
    }

    public function render()
    {
        return view('livewire.enrollments.manage-form', [
            'studentsByGradeAndSection' => $this->getStudentsByGradeAndSection(),
        ]);
    }
}

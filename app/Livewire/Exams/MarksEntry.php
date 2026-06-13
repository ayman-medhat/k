<?php

namespace App\Livewire\Exams;

use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\ExamRecord;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class MarksEntry extends Component
{
    public Exam $exam;
    public $section_id = '';
    public $records = [];

    public function mount(Exam $exam)
    {
        $this->exam = $exam;
    }

    #[Computed]
    public function sections()
    {
        return Section::where('grade_id', $this->exam->grade_id)
            ->orderBy('name')
            ->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function examSubjects()
    {
        return $this->exam->subjects()->orderBy('name')->get();
    }

    public function updatedSectionId()
    {
        $this->loadStudents();
    }

    protected function loadStudents()
    {
        if (!$this->section_id) {
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

        $existingRecords = ExamRecord::where('exam_id', $this->exam->id)
            ->whereIn('student_id', $enrolledStudents->pluck('student_id'))
            ->get()
            ->groupBy('student_id');

        $subjects = $this->examSubjects;

        $this->records = $enrolledStudents->map(function ($enrollment) use ($existingRecords, $subjects) {
            $studentRecords = $existingRecords->get($enrollment->student_id, collect())->keyBy('subject_id');
            $marks = [];
            foreach ($subjects as $subject) {
                $existing = $studentRecords->get($subject->id);
                $marks[] = [
                    'subject_id' => $subject->id,
                    'subject_name' => $subject->name,
                    'max_marks' => $subject->pivot->max_marks,
                    'marks_obtained' => $existing?->marks_obtained ?? '',
                    'record_id' => $existing?->id,
                ];
            }
            return [
                'student_id' => $enrollment->student_id,
                'student_name' => $enrollment->student->contact?->nameEn ?? 'N/A',
                'marks' => $marks,
            ];
        })->toArray();
    }

    public function save()
    {
        $this->validate([
            'records.*.marks.*.marks_obtained' => 'nullable|numeric|min:0',
        ]);

        foreach ($this->records as $record) {
            foreach ($record['marks'] as $mark) {
                if ($mark['marks_obtained'] === '' || $mark['marks_obtained'] === null) {
                    continue;
                }
                $data = [
                    'exam_id' => $this->exam->id,
                    'student_id' => $record['student_id'],
                    'subject_id' => $mark['subject_id'],
                    'marks_obtained' => $mark['marks_obtained'],
                ];

                if ($mark['record_id']) {
                    ExamRecord::findOrFail($mark['record_id'])->update($data);
                } else {
                    ExamRecord::create($data);
                }
            }
        }

        $this->redirect(route('exams.marks', $this->exam), navigate: true);
    }

    public function render()
    {
        return view('livewire.exams.marks-entry');
    }
}

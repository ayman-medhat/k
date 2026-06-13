<?php

namespace App\Livewire\Exams;

use App\Models\AcademicYear;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Term;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    public ?Exam $exam = null;

    public $name = '';
    public $grade_id = '';
    public $term_id = '';
    public $date = '';
    public $description = '';
    public $subjects = [];

    public function mount(?Exam $exam = null)
    {
        if (auth()->user()->role === 'parent') {
            $this->redirect(route('parent.dashboard'), navigate: true);
            return;
        }

        $this->exam = $exam;

        if ($exam) {
            $this->name = $exam->name;
            $this->grade_id = (string) $exam->grade_id;
            $this->term_id = (string) $exam->term_id;
            $this->date = $exam->date->format('Y-m-d');
            $this->description = $exam->description;

            foreach ($exam->subjects as $subject) {
                $this->subjects[] = [
                    'subject_id' => (string) $subject->id,
                    'max_marks' => (string) $subject->pivot->max_marks,
                ];
            }
        } else {
            $this->date = now()->format('Y-m-d');
            $currentYear = AcademicYear::where('is_current', true)->first();
            if ($currentYear) {
                $currentTerm = Term::where('academic_year_id', $currentYear->id)
                    ->where('is_current', true)->first();
                if ($currentTerm) {
                    $this->term_id = (string) $currentTerm->id;
                }
            }
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'term_id' => 'required|exists:terms,id',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'subjects' => 'required|array|min:1',
            'subjects.*.subject_id' => 'required|exists:subjects,id',
            'subjects.*.max_marks' => 'required|numeric|min:0.01',
        ];
    }

    #[Computed]
    public function gradeOptions()
    {
        return Grade::orderBy('level_order')->get(['id', 'name', 'name_ar']);
    }

    #[Computed]
    public function termOptions()
    {
        return Term::with('academicYear')->orderBy('start_date')->get();
    }

    #[Computed]
    public function subjectOptions()
    {
        if (!$this->grade_id) return collect();

        return Subject::whereHas('grades', fn($q) => $q->where('grade_id', $this->grade_id))
            ->orderBy('name')
            ->get(['id', 'name', 'name_ar']);
    }

    public function addSubject()
    {
        $this->subjects[] = ['subject_id' => '', 'max_marks' => ''];
    }

    public function removeSubject($index)
    {
        unset($this->subjects[$index]);
        $this->subjects = array_values($this->subjects);
    }

    public function updatedGradeId()
    {
        $this->subjects = [];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'grade_id' => $this->grade_id,
            'term_id' => $this->term_id,
            'date' => $this->date,
            'description' => $this->description,
        ];

        if ($this->exam) {
            $this->exam->update($data);
        } else {
            $this->exam = Exam::create($data);
        }

        $subjectData = [];
        foreach ($this->subjects as $subject) {
            $subjectData[$subject['subject_id']] = ['max_marks' => $subject['max_marks']];
        }
        $this->exam->subjects()->sync($subjectData);

        $this->redirect(route('exams'), navigate: true);
    }

    public function render()
    {
        return view('livewire.exams.manage-form');
    }
}

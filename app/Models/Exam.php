<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'name', 'grade_id', 'term_id', 'date', 'description'
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'exam_subject')
            ->withPivot('max_marks')
            ->withTimestamps();
    }

    public function records()
    {
        return $this->hasMany(ExamRecord::class);
    }
}

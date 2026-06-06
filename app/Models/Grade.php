<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'name', 'name_ar', 'level_order', 'description'
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'grade_subject');
    }

    public function stages()
    {
        return $this->belongsToMany(Stage::class, 'grade_stage');
    }

    public function subjectsForReligion(?string $religion)
    {
        $subjects = $this->subjects()->with('children')->get();

        return $subjects->flatMap(function ($subject) use ($religion) {
            if ($subject->is_religion_based && $subject->children->count()) {
                $child = $subject->children->where('religion', $religion)->first();
                return $child ? [$child] : [];
            }
            if ($subject->parent_id && $subject->parent && $subject->parent->is_religion_based) {
                return [];
            }
            return [$subject];
        });
    }
}

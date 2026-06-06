<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name', 'name_ar', 'description', 'parent_id', 'is_main', 'is_religion_based', 'religion'
    ];

    protected function casts(): array
    {
        return [
            'is_main' => 'boolean',
            'is_religion_based' => 'boolean',
        ];
    }

    public function parent()
    {
        return $this->belongsTo(Subject::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Subject::class, 'parent_id');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'grade_subject');
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeMain($query)
    {
        return $query->where('is_main', true);
    }

    public function scopeOptional($query)
    {
        return $query->where('is_main', false);
    }

    public function scopeForReligion($query, ?string $religion)
    {
        if (!$religion) return $query->where('is_religion_based', false);

        return $query->where(function ($q) use ($religion) {
            $q->where('is_religion_based', false)
              ->orWhere(function ($sub) use ($religion) {
                  $sub->where('is_religion_based', true)
                      ->where('religion', $religion);
              });
        });
    }
}

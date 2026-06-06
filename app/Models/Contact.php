<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'nameEn', 'nameAr', 'email', 'phone', 'nationality', 'religion', 'gender', 'categories',
        'national_id', 'passport_no', 'birth_date', 'status', 'source', 'notes', 'parent_id', 'mother_id',
        'grade_id', 'second_language_subject_id'
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'categories' => 'array',
        ];
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class, 'contact_id');
    }

    public function parent()
    {
        return $this->belongsTo(Contact::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Contact::class, 'parent_id');
    }

    public function mother()
    {
        return $this->belongsTo(Contact::class, 'mother_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function secondLanguageSubject()
    {
        return $this->belongsTo(Subject::class, 'second_language_subject_id');
    }

    public function assignedSubjects()
    {
        if (! $this->grade) return collect();

        $subjects = $this->grade->subjectsForReligion($this->religion);

        if ($this->secondLanguageSubject) {
            $subjects = $subjects->map(function ($subject) {
                if ($subject->name === 'Second Language' && !$subject->parent_id) {
                    return $this->secondLanguageSubject;
                }
                return $subject;
            });
        }

        return $subjects->values();
    }

    public function getAgeAttribute()
    {
        if ($this->birth_date) {
            return $this->birth_date->age;
        }
        return null;
    }

    public function getDetailedAgeAttribute()
    {
        if ($this->birth_date) {
            $diff = $this->birth_date->diff(now());
            return "{$diff->y}y, {$diff->m}m, {$diff->d}d";
        }
        return null;
    }

    public static function extractBirthDateFromNationalId($nationalId)
    {
        if (strlen($nationalId) !== 14) return null;

        $century = substr($nationalId, 0, 1);
        $year = substr($nationalId, 1, 2);
        $month = substr($nationalId, 3, 2);
        $day = substr($nationalId, 5, 2);

        $fullYear = ($century == '2' ? '19' : '20') . $year;

        try {
            return \Carbon\Carbon::createFromFormat('Y-m-d', "$fullYear-$month-$day");
        } catch (\Exception $e) {
            return null;
        }
    }

    protected static function booted()
    {
        static::saving(function ($contact) {
            if ($contact->nationality === 'Egyptian' && !empty($contact->national_id)) {
                $contact->birth_date = self::extractBirthDateFromNationalId($contact->national_id);
            }
        });
    }
}
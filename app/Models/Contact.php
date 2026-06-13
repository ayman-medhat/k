<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'nameEn', 'nameAr', 'email', 'phone',
        'nationality', 'nationality_ar',
        'religion', 'religion_ar',
        'gender', 'gender_ar',
        'categories',
        'national_id', 'passport_no', 'birth_date',
        'status', 'status_ar',
        'source', 'source_ar',
        'notes', 'notes_ar',
        'photo',
        'parent_id', 'mother_id',
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

    public function documents()
    {
        return $this->hasMany(ContactDocument::class);
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

    public function student()
    {
        return $this->hasOne(Student::class, 'contact_id');
    }

    public function assignedSubjects()
    {
        $student = $this->student;
        if (!$student || !$student->grade) return collect();

        $subjects = $student->grade->subjectsForReligion($this->religion);

        if ($student->secondLanguage) {
            $subjects = $subjects->map(function ($subject) use ($student) {
                if ($subject->name === 'Second Language' && !$subject->parent_id) {
                    return $student->secondLanguage;
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
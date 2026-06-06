<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
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
        return $this->hasMany(Interaction::class);
    }

    public function parent()
    {
        return $this->belongsTo(Lead::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Lead::class, 'parent_id');
    }

    public function mother()
    {
        return $this->belongsTo(Lead::class, 'mother_id');
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

        // If the student has chosen a second language child, replace the parent
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

    public function transferToContact(): Contact
    {
        $contact = Contact::create([
            'nameEn' => $this->nameEn,
            'nameAr' => $this->nameAr,
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality,
            'religion' => $this->religion,
            'gender' => $this->gender,
            'national_id' => $this->national_id,
            'passport_no' => $this->passport_no,
            'birth_date' => $this->birth_date,
            'status' => 'Active',
            'source' => $this->source,
            'notes' => $this->notes,
            'categories' => $this->categories,
            'parent_id' => null,
            'mother_id' => null,
        ]);

        if (in_array('Student', $this->categories ?? [])) {
            Student::create([
                'contact_id' => $contact->id,
                'grade_id' => $this->grade_id ?? 1,
                'second_language_id' => $this->second_language_subject_id,
                'age_at_october' => $this->birth_date
                    ? Student::calculateAgeAtOctober($this->birth_date->format('Y-m-d'))
                    : null,
            ]);
        }

        $this->interactions()->each(function ($interaction) use ($contact) {
            $interaction->update(['contact_id' => $contact->id]);
        });

        return $contact;
    }

    protected static function booted()
    {
        static::saving(function ($lead) {
            if ($lead->nationality === 'Egyptian' && !empty($lead->national_id)) {
                $lead->birth_date = self::extractBirthDateFromNationalId($lead->national_id);
            }
        });
    }
}

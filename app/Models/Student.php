<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'contact_id', 'grade_id', 'section_id', 'second_language_id',
        'government_code', 'seat_no', 'secret_code',
        'father_id', 'mother_id', 'guardian', 'photo', 'age_at_october',
    ];

    protected function casts(): array
    {
        return [
            'age_at_october' => 'integer',
        ];
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function secondLanguage()
    {
        return $this->belongsTo(Subject::class, 'second_language_id');
    }

    public function father()
    {
        return $this->belongsTo(Contact::class, 'father_id');
    }

    public function mother()
    {
        return $this->belongsTo(Contact::class, 'mother_id');
    }

    public function getContactNameAttribute()
    {
        return $this->contact?->nameEn ?? 'N/A';
    }

    public static function calculateAgeAtOctober(?string $birthDate): ?int
    {
        if (!$birthDate) return null;

        $birth = Carbon::parse($birthDate);
        $oct1 = Carbon::create(now()->year, 10, 1);

        return $birth->diffInYears($oct1);
    }

    public static function formatAgeAtOctober(?string $birthDate): ?string
    {
        if (!$birthDate) return null;

        $birth = Carbon::parse($birthDate);
        $oct1 = Carbon::create(now()->year, 10, 1);

        if ($oct1->lessThan($birth)) return null;

        $diff = $birth->diff($oct1);

        $parts = [];
        if (app()->getLocale() === 'ar') {
            if ($diff->y > 0) $parts[] = $diff->y . ' سنة' . ($diff->y > 1 && $diff->y < 11 ? '' : '');
            if ($diff->m > 0) $parts[] = $diff->m . ' شهر' . ($diff->m > 1 && $diff->m < 11 ? '' : '');
            if ($diff->d >= 0) $parts[] = $diff->d . ' يوم' . ($diff->d > 1 && $diff->d < 11 ? '' : '');
        } else {
            if ($diff->y > 0) $parts[] = $diff->y . ' year' . ($diff->y > 1 ? 's' : '');
            if ($diff->m > 0) $parts[] = $diff->m . ' month' . ($diff->m > 1 ? 's' : '');
            if ($diff->d >= 0) $parts[] = $diff->d . ' day' . ($diff->d > 1 ? 's' : '');
        }

        return implode(', ', $parts);
    }
}

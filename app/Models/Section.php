<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'grade_id', 'name', 'name_ar'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public static function arabicLetter($letter)
    {
        $map = [
            'A' => 'أ', 'B' => 'ب', 'C' => 'ت', 'D' => 'ث', 'E' => 'ج',
            'F' => 'ح', 'G' => 'خ', 'H' => 'د', 'I' => 'ذ', 'J' => 'ر',
            'K' => 'ز', 'L' => 'س', 'M' => 'ش', 'N' => 'ص', 'O' => 'ض',
            'P' => 'ط', 'Q' => 'ظ', 'R' => 'ع', 'S' => 'غ', 'T' => 'ف',
            'U' => 'ق', 'V' => 'ك', 'W' => 'ل', 'X' => 'م', 'Y' => 'ن',
            'Z' => 'ه',
        ];
        return $map[$letter] ?? $letter;
    }

    public static function generateForGrade($gradeId, $count)
    {
        $existing = static::where('grade_id', $gradeId)->pluck('name')->toArray();
        $letters = range('A', 'Z');
        $created = 0;

        foreach ($letters as $letter) {
            if ($created >= $count) break;
            if (in_array($letter, $existing)) continue;

            static::create([
                'grade_id' => $gradeId,
                'name' => $letter,
                'name_ar' => static::arabicLetter($letter),
            ]);
            $created++;
        }

        return $created;
    }
}

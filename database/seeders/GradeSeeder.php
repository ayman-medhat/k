<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        Section::query()->delete();
        Grade::query()->delete();

        $grades = [
            ['name' => 'Pre-KG',    'name_ar' => 'ما قبل الروضة',       'level_order' => 0, 'description' => 'Pre-Kindergarten — early learning foundation'],
            ['name' => 'KG1',       'name_ar' => 'أولى رياض أطفال',     'level_order' => 0, 'description' => 'Kindergarten 1 — ages 4–5'],
            ['name' => 'KG2',       'name_ar' => 'ثانية رياض أطفال',    'level_order' => 0, 'description' => 'Kindergarten 2 — ages 5–6'],

            ['name' => 'Grade 1',   'name_ar' => 'أولى إبتدائى',       'level_order' => 1, 'description' => 'First grade — basics of reading, writing, and arithmetic'],
            ['name' => 'Grade 2',   'name_ar' => 'ثانية إبتدائى',      'level_order' => 1, 'description' => 'Second grade — building literacy and numeracy'],
            ['name' => 'Grade 3',   'name_ar' => 'ثالثة إبتدائى',      'level_order' => 1, 'description' => 'Third grade — introduction to science and social studies'],
            ['name' => 'Grade 4',   'name_ar' => 'رابعة إبتدائى',      'level_order' => 1, 'description' => 'Fourth grade — expanded subjects and critical thinking'],
            ['name' => 'Grade 5',   'name_ar' => 'خامسة إبتدائى',      'level_order' => 1, 'description' => 'Fifth grade — preparing for middle school transition'],
            ['name' => 'Grade 6',   'name_ar' => 'سادسة إبتدائى',      'level_order' => 1, 'description' => 'Sixth grade — final year of primary education'],

            ['name' => 'Grade 7',   'name_ar' => 'أولى إعدادى',        'level_order' => 2, 'description' => 'Seventh grade — first year of preparatory/middle school'],
            ['name' => 'Grade 8',   'name_ar' => 'ثانية إعدادى',       'level_order' => 2, 'description' => 'Eighth grade — deeper exploration of STEM and humanities'],
            ['name' => 'Grade 9',   'name_ar' => 'ثالثة إعدادى',       'level_order' => 2, 'description' => 'Ninth grade — final preparatory year before high school'],

            ['name' => 'Grade 10',  'name_ar' => 'أولى ثانوى',         'level_order' => 3, 'description' => 'Tenth grade — secondary school foundation year'],
            ['name' => 'Grade 11',  'name_ar' => 'ثانية ثانوى',        'level_order' => 3, 'description' => 'Eleventh grade — academic specialization begins'],
            ['name' => 'Grade 12',  'name_ar' => 'ثالثة ثانوى',        'level_order' => 3, 'description' => 'Twelfth grade — final year, graduation and university preparation'],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}

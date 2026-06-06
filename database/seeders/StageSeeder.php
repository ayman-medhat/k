<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Stage;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    public function run(): void
    {
        Stage::query()->delete();

        $stages = [
            [
                'name' => 'Pre-K & KG',
                'name_ar' => 'مرحلة ما قبل الروضة ورياض الأطفال',
                'level_order' => 0,
                'description' => 'Early years foundation — Pre-KG, KG1, KG2',
                'grades' => ['Pre-KG', 'KG1', 'KG2'],
            ],
            [
                'name' => 'Primary',
                'name_ar' => 'المرحلة الإبتدائية',
                'level_order' => 1,
                'description' => 'Primary education — Grades 1 through 6',
                'grades' => ['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6'],
            ],
            [
                'name' => 'Preparatory',
                'name_ar' => 'المرحلة الإعدادية',
                'level_order' => 2,
                'description' => 'Middle school — Grades 7 through 9',
                'grades' => ['Grade 7', 'Grade 8', 'Grade 9'],
            ],
            [
                'name' => 'Secondary',
                'name_ar' => 'المرحلة الثانوية',
                'level_order' => 3,
                'description' => 'High school — Grades 10 through 12',
                'grades' => ['Grade 10', 'Grade 11', 'Grade 12'],
            ],
        ];

        foreach ($stages as $data) {
            $gradeNames = $data['grades'];
            unset($data['grades']);

            $stage = Stage::create($data);

            $gradeIds = Grade::whereIn('name', $gradeNames)->pluck('id');
            $stage->grades()->sync($gradeIds);
        }
    }
}

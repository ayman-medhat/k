<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        Subject::truncate();

        // Mathematics with branches
        $math = Subject::create(["name" => "Mathematics", "name_ar" => "الرياضيات", "description" => "Core mathematics covering numbers, operations, and problem-solving", "is_main" => true]);
        Subject::create(["name" => "Algebra", "name_ar" => "الجبر", "parent_id" => $math->id, "is_main" => true, "description" => "Algebraic expressions, equations, and functions"]);
        Subject::create(["name" => "Geometry", "name_ar" => "الهندسة", "parent_id" => $math->id, "is_main" => true, "description" => "Shapes, angles, proofs, and spatial reasoning"]);
        Subject::create(["name" => "Trigonometry", "name_ar" => "علم المثلثات", "parent_id" => $math->id, "is_main" => false, "description" => "Triangles, trigonometric functions, and identities"]);

        // Science with branches
        $science = Subject::create(["name" => "Science", "name_ar" => "العلوم", "description" => "General science foundation covering natural phenomena", "is_main" => true]);
        Subject::create(["name" => "Physics", "name_ar" => "الفيزياء", "parent_id" => $science->id, "is_main" => true, "description" => "Matter, energy, motion, and fundamental forces"]);
        Subject::create(["name" => "Chemistry", "name_ar" => "الكيمياء", "parent_id" => $science->id, "is_main" => true, "description" => "Elements, compounds, reactions, and chemical processes"]);
        Subject::create(["name" => "Biology", "name_ar" => "الأحياء", "parent_id" => $science->id, "is_main" => true, "description" => "Living organisms, cells, genetics, and ecosystems"]);

        // Language Arts
        Subject::create(["name" => "Arabic Language", "name_ar" => "اللغة العربية", "is_main" => true, "description" => "Arabic reading, writing, grammar, and literature"]);
        Subject::create(["name" => "English OL", "name_ar" => "اللغة الإنجليزية", "is_main" => true, "description" => "English reading, writing, grammar, and comprehension (Ordinary Level)"]);
        Subject::create(["name" => "English AL", "name_ar" => "اللغة الإنجليزية (متقدم)", "is_main" => true, "description" => "Advanced English literature, composition, and critical analysis (Advanced Level)"]);

        // Second Language (required — student chooses one option)
        $secondLang = Subject::create([
            "name" => "Second Language",
            "name_ar" => "اللغة الثانية",
            "is_main" => true,
            "description" => "Students choose one foreign language from the available options",
        ]);
        Subject::create(["name" => "French", "name_ar" => "الفرنسية", "parent_id" => $secondLang->id, "is_main" => false, "description" => "French language — speaking, writing, and culture"]);
        Subject::create(["name" => "German", "name_ar" => "الألمانية", "parent_id" => $secondLang->id, "is_main" => false, "description" => "German language — speaking, writing, and culture"]);
        Subject::create(["name" => "Spanish", "name_ar" => "الإسبانية", "parent_id" => $secondLang->id, "is_main" => false, "description" => "Spanish language — speaking, writing, and culture"]);
        Subject::create(["name" => "Italian", "name_ar" => "الإيطالية", "parent_id" => $secondLang->id, "is_main" => false, "description" => "Italian language — speaking, writing, and culture"]);

        // Religious Education (religion-based)
        $religious = Subject::create([
            "name" => "Religious Education",
            "name_ar" => "التربية الدينية",
            "is_main" => true,
            "is_religion_based" => true,
            "description" => "Splits into Islamic and Christian tracks based on student religion",
        ]);
        Subject::create([
            "name" => "Islamic Education",
            "name_ar" => "التربية الإسلامية",
            "parent_id" => $religious->id,
            "is_main" => true,
            "religion" => "Muslim",
            "description" => "Quran, Hadith, Fiqh, and Islamic studies for Muslim students",
        ]);
        Subject::create([
            "name" => "Christian Education",
            "name_ar" => "التربية المسيحية",
            "parent_id" => $religious->id,
            "is_main" => true,
            "religion" => "Christian",
            "description" => "Bible studies, Christian ethics, and religious teachings for Christian students",
        ]);

        // Social Studies (parent)
        $socialStudies = Subject::create(["name" => "Social Studies", "name_ar" => "الدراسات الاجتماعية", "is_main" => true, "description" => "Study of human society, history, and geography"]);
        Subject::create(["name" => "History", "name_ar" => "التاريخ", "parent_id" => $socialStudies->id, "is_main" => true, "description" => "World and national history, civilizations, and historical analysis"]);
        Subject::create(["name" => "Geography", "name_ar" => "الجغرافيا", "parent_id" => $socialStudies->id, "is_main" => true, "description" => "Physical and human geography, maps, and environmental studies"]);

        // Other
        Subject::create(["name" => "Physical Education", "name_ar" => "التربية البدنية", "is_main" => false, "description" => "Sports, fitness, motor skills, and healthy lifestyle"]);
        Subject::create(["name" => "Art", "name_ar" => "التربية الفنية", "is_main" => false, "description" => "Visual arts, drawing, painting, and creative expression"]);
        Subject::create(["name" => "Computer Science", "name_ar" => "علوم الحاسب", "is_main" => false, "description" => "Computers, programming, digital literacy, and technology skills"]);

        // Assign English OL, Arabic Language, and Mathematics to all grades
        $subjectNames = ['English OL', 'Arabic Language', 'Mathematics'];
        $subjectIds = Subject::whereIn('name', $subjectNames)->pluck('id');
        $gradeIds = Grade::pluck('id');

        $pivotData = [];
        foreach ($gradeIds as $gradeId) {
            foreach ($subjectIds as $subjectId) {
                $pivotData[] = ['grade_id' => $gradeId, 'subject_id' => $subjectId];
            }
        }

        if (!empty($pivotData)) {
            \DB::table('grade_subject')->insertOrIgnore($pivotData);
        }
    }
}

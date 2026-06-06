<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Migrate existing student contacts to the students table
        $contacts = DB::table('contacts')
            ->whereJsonContains('categories', 'Student')
            ->get();

        foreach ($contacts as $contact) {
            $birthDate = $contact->birth_date;
            $ageAtOctober = null;
            if ($birthDate) {
                $birth = \Carbon\Carbon::parse($birthDate);
                $oct1 = \Carbon\Carbon::create(now()->year, 10, 1);
                $ageAtOctober = (int) $birth->diffInYears($oct1);
                if ($oct1->lessThan($birth->copy()->addYears($ageAtOctober))) {
                    $ageAtOctober--;
                }
            }

            DB::table('students')->insert([
                'contact_id' => $contact->id,
                'grade_id' => $contact->grade_id ?? 1,
                'section_id' => null,
                'second_language_id' => $contact->second_language_subject_id,
                'government_code' => null,
                'seat_no' => null,
                'secret_code' => null,
                'father_id' => $contact->parent_id,
                'mother_id' => $contact->mother_id,
                'guardian' => 'father',
                'photo' => null,
                'age_at_october' => $ageAtOctober,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Drop foreign key constraints first
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['grade_id']);
            $table->dropForeign(['second_language_subject_id']);
        });

        // Drop the columns
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('grade_id');
            $table->dropColumn('second_language_subject_id');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('grade_id')->nullable()->after('mother_id')->constrained()->nullOnDelete();
            $table->foreignId('second_language_subject_id')->nullable()->after('grade_id')->constrained('subjects')->nullOnDelete();
        });

        // Migrate data back from students to contacts
        $students = DB::table('students')->get();
        foreach ($students as $student) {
            DB::table('contacts')
                ->where('id', $student->contact_id)
                ->update([
                    'grade_id' => $student->grade_id,
                    'second_language_subject_id' => $student->second_language_id,
                ]);
        }

        Schema::dropIfExists('students');
    }
};

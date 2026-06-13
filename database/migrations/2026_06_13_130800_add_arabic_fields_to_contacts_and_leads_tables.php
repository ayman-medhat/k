<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('nationality_ar')->nullable()->after('nationality');
            $table->string('religion_ar')->nullable()->after('religion');
            $table->string('gender_ar')->nullable()->after('gender');
            $table->text('notes_ar')->nullable()->after('notes');
            $table->string('source_ar')->nullable()->after('source');
            $table->string('status_ar')->nullable()->after('status');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->string('nationality_ar')->nullable()->after('nationality');
            $table->string('national_id_ar', 14)->nullable()->after('national_id');
            $table->string('passport_no_ar')->nullable()->after('passport_no');
            $table->string('status_ar')->nullable()->after('status');
            $table->string('source_ar')->nullable()->after('source');
            $table->text('notes_ar')->nullable()->after('notes');
            $table->string('religion_ar')->nullable()->after('religion');
            $table->string('gender_ar')->nullable()->after('gender');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'nationality_ar', 'religion_ar', 'gender_ar',
                'notes_ar', 'source_ar', 'status_ar',
            ]);
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'nationality_ar', 'national_id_ar', 'passport_no_ar',
                'status_ar', 'source_ar', 'notes_ar', 'religion_ar', 'gender_ar',
            ]);
        });
    }
};

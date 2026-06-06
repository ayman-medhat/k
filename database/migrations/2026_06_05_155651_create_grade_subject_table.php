<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("grade_subject", function (Blueprint $table) {
            $table->id();
            $table->foreignId("grade_id")->constrained()->cascadeOnDelete();
            $table->foreignId("subject_id")->constrained()->cascadeOnDelete();
            $table->unique(["grade_id", "subject_id"]);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("grade_subject");
    }
};

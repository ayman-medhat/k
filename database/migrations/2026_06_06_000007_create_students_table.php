<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('grade_id')->constrained()->cascadeOnDelete();
            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('second_language_id')->nullable()->constrained('subjects')->nullOnDelete();
            $table->string('government_code')->nullable();
            $table->string('seat_no')->nullable();
            $table->string('secret_code')->nullable();
            $table->foreignId('father_id')->nullable()->constrained('contacts')->nullOnDelete();
            $table->foreignId('mother_id')->nullable()->constrained('contacts')->nullOnDelete();
            $table->string('guardian')->default('father');
            $table->string('photo')->nullable();
            $table->unsignedInteger('age_at_october')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

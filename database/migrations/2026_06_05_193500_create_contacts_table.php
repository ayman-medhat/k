<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('nameEn');
            $table->string('nameAr');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nationality')->default('Egyptian');
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->string('national_id', 14)->unique()->nullable();
            $table->string('passport_no')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('status')->default('Active');
            $table->string('source')->nullable();
            $table->text('notes')->nullable();
            $table->string('category')->default('Parent');
            $table->foreignId('parent_id')->nullable()->constrained('contacts')->nullOnDelete();
            $table->foreignId('grade_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('second_language_subject_id')->nullable()->constrained('subjects')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
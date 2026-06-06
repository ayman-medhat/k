<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('nameEn');
            $table->string('nameAr');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nationality')->default('Egyptian');
            $table->string('national_id', 14)->unique()->nullable();
            $table->string('passport_no')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('status')->default('New');
            $table->string('source')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

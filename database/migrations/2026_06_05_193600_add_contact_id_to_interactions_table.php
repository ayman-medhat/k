<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interactions', function (Blueprint $table) {
            $table->foreignId('contact_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('interactions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('contact_id');
        });
    }
};
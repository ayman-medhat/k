<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('notes_ar');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('notes_ar');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('photo');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->foreignId('mother_id')->nullable()->after('parent_id')->constrained('leads')->nullOnDelete();
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('mother_id')->nullable()->after('parent_id')->constrained('contacts')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['mother_id']);
            $table->dropColumn('mother_id');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['mother_id']);
            $table->dropColumn('mother_id');
        });
    }
};

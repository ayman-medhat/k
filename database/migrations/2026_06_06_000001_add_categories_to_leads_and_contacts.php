<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->jsonb('categories')->default('[]');
        });

        DB::statement("UPDATE leads SET categories = to_jsonb(ARRAY[category]) WHERE category IS NOT NULL");

        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->jsonb('categories')->default('[]');
        });

        DB::statement("UPDATE contacts SET categories = to_jsonb(ARRAY[category]) WHERE category IS NOT NULL");

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('category')->default('Parent');
        });
        DB::statement("UPDATE contacts SET category = categories->>0 WHERE categories IS NOT NULL AND jsonb_array_length(categories) > 0");

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('categories');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->string('category')->default('Parent');
        });
        DB::statement("UPDATE leads SET category = categories->>0 WHERE categories IS NOT NULL AND jsonb_array_length(categories) > 0");

        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('categories');
        });
    }
};

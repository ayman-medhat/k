<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table("leads", function (Blueprint $table) {
            $table->string("religion")->nullable()->after("nationality");
            $table->string("gender")->nullable()->after("religion");
        });
    }

    public function down(): void
    {
        Schema::table("leads", function (Blueprint $table) {
            $table->dropColumn(["religion", "gender"]);
        });
    }
};

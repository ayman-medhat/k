<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table("subjects", function (Blueprint $table) {
            $table->foreignId("parent_id")->nullable()->constrained("subjects")->cascadeOnDelete()->after("description");
            $table->boolean("is_main")->default(true)->after("parent_id");
            $table->boolean("is_religion_based")->default(false)->after("is_main");
            $table->string("religion")->nullable()->after("is_religion_based");
        });
    }

    public function down(): void
    {
        Schema::table("subjects", function (Blueprint $table) {
            $table->dropForeign(["parent_id"]);
            $table->dropColumn(["parent_id", "is_main", "is_religion_based", "religion"]);
        });
    }
};

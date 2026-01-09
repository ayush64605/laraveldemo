<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable("projects")) {
            Schema::table("projects", function (Blueprint $table) {
                if (Schema::hasColumn('projects', 'demo_column')) {
                    $table->renameColumn("demo_column", "column_demo");
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable("projects")) {
            Schema::table("projects", function (Blueprint $table) {
                if (Schema::hasColumn('projects', 'column_demo')) {
                    $table->renameColumn("column_demo", "demo_column");
                }
            });
        }
    }
};

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
            Schema::table('projects', function (Blueprint $table) {
                $table->unsignedBigInteger('project_category')->nullable()->after('id');
                $table->foreign('project_category')
                    ->references('id')
                    ->on('projectcategories')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable("projects")) {
            Schema::table('projects', function (Blueprint $table) {
                if (Schema::hasColumn('projects', 'project_category')) {
                    $table->dropForeign(['project_category']);
                    $table->dropColumn('project_category');
                }
            });
        }
    }
};

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
        if (!Schema::hasTable('employee_projects')) {
            Schema::create('employee_projects', function (Blueprint $table) {
                $table->id();
                $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
                $table->foreignId('employee_id')->references('id')->on('employees')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('employee_projects')) {
            Schema::dropIfExists('employee_projects');
        }
    }
};

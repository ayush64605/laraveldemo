<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('project_code')->unique();
            $table->string('project_key')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Completed', 'On Hold'])->default('Active');
            $table->boolean('is_featured')->default(false);
            $table->enum('priority', ['Low', 'Medium', 'High', 'Urgent'])->default('Medium');
            $table->tinyInteger('progress')->unsigned()->default(0);
            $table->decimal('budget', 15, 2)->nullable();
            $table->string('project_url')->nullable();
            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->time('deadline_time')->nullable();
            $table->string('project_type')->nullable();
            $table->json('technologies')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
                        $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('client_pan', 10)->nullable();
            $table->string('client_phone', 20)->nullable();
            $table->string('client_company')->nullable();
            $table->string('client_website')->nullable();
            $table->text('client_address')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

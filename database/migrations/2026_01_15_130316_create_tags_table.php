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
        if (!Schema::hasTable("tags")) {
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable("taggables")) {
            Schema::create('taggables', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tag_id')->constrained()->onDelete('cascade');
                $table->morphs('taggable');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable("tags")) {
            Schema::dropIfExists('tags');
        }

        if (!Schema::hasTable("taggables")) {
            Schema::dropIfExists('taggables');
        }
    }
};

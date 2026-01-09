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
        if (Schema::hasTable("projects") && !Schema::hasColumn("projects", "client_name")) {
            Schema::table("projects", function (Blueprint $table) {
                $table->after('image', function (Blueprint $table) {
                    $table->string('client_name');
                    $table->string('client_email');
                    $table->integer('client_phone');
                    $table->string('client_company')->nullable();
                    $table->string('client_pan')->nullable();
                    $table->string('client_website')->nullable();
                    $table->string('client_address')->nullable();
                });
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable("projects") && Schema::hasColumn("projects", "client_name")) {
            Schema::table(('projects'), function (Blueprint $table) {
                $table->dropColumn('client_name');
                $table->dropColumn('client_email');
                $table->dropColumn('client_phone');
                $table->dropColumn('client_company');
                $table->dropColumn('client_pan');
                $table->dropColumn('client_website');
                $table->dropColumn('client_address');
            });
        }
    }
};

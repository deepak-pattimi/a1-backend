<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            if (!Schema::hasColumn('about_pages', 'doctor_overview_heading')) {
                $table->string('doctor_overview_heading')->nullable();
            }
            if (!Schema::hasColumn('about_pages', 'doctor_expertise_heading')) {
                $table->string('doctor_expertise_heading')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn(['doctor_overview_heading', 'doctor_expertise_heading']);
        });
    }
};

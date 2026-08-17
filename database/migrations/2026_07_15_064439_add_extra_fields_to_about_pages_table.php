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
            $table->string('doctor_awards_heading')->nullable();
            $table->json('doctor_awards')->nullable();
            $table->string('doctor_memberships_heading')->nullable();
            $table->json('doctor_memberships')->nullable();
            $table->string('doctor_research_heading')->nullable();
            $table->json('doctor_research')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn([
                'doctor_awards_heading',
                'doctor_awards',
                'doctor_memberships_heading',
                'doctor_memberships',
                'doctor_research_heading',
                'doctor_research'
            ]);
        });
    }
};

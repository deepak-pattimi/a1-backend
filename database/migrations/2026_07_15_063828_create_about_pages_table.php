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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            
            // Hero section
            $table->string('tagline')->nullable();
            $table->string('sub_tagline')->nullable();
            
            // Clinic section
            $table->string('clinic_heading')->nullable();
            $table->text('clinic_description')->nullable();
            $table->json('clinic_services')->nullable();
            
            // Doctor section
            $table->string('doctor_heading')->nullable();
            $table->string('doctor_name')->nullable();
            $table->json('doctor_designations')->nullable();
            $table->string('doctor_image')->nullable();
            $table->text('doctor_overview')->nullable();
            $table->json('doctor_expertise')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};

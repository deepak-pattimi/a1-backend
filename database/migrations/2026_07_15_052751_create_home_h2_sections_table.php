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
        Schema::create('home_h2_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_title')->nullable();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            
            // Stats (value and text)
            $table->string('stat_1_value')->nullable();
            $table->string('stat_1_text')->nullable();
            
            $table->string('stat_2_value')->nullable();
            $table->string('stat_2_text')->nullable();
            
            $table->string('stat_3_value')->nullable();
            $table->string('stat_3_text')->nullable();
            
            $table->string('stat_4_value')->nullable();
            $table->string('stat_4_text')->nullable();
            
            $table->json('features')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_h2_sections');
    }
};

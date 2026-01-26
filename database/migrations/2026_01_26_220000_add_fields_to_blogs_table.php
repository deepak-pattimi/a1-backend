<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('category')->nullable();
            $table->text('tags')->nullable();
            $table->string('read_time')->nullable();
            $table->integer('views')->default(0);
            $table->string('author_role')->nullable();
            $table->string('author_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['category', 'tags', 'read_time', 'views', 'author_role', 'author_image']);
        });
    }
};

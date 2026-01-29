<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYtvideoTable extends Migration
{
    public function up()
    {
        Schema::create('ytvideo', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->string('youtubelink')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ytvideo');
    }
}

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKingggTable extends Migration
{
    public function up()
    {
        Schema::create('kinggg', function (Blueprint $table) {
            $table->id();
            $table->string('tts')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kinggg');
    }
}

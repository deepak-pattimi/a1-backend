<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('contacts')) {
            Schema::create('contacts', function (Blueprint $table) {
                $table->id();
                $table->string('fullname');
                $table->string('mobile');
                $table->string('email')->nullable();
                $table->string('reason')->nullable();
                $table->text('message')->nullable();
                $table->enum('status', ['unread', 'read'])->default('unread');
                $table->timestamps();
            });
        } else {
            Schema::table('contacts', function (Blueprint $table) {
                if (!Schema::hasColumn('contacts', 'fullname')) {
                    $table->string('fullname')->nullable();
                }
                if (!Schema::hasColumn('contacts', 'mobile')) {
                    $table->string('mobile')->nullable();
                }
                if (!Schema::hasColumn('contacts', 'reason')) {
                    $table->string('reason')->nullable();
                }
                if (!Schema::hasColumn('contacts', 'status')) {
                    $table->enum('status', ['unread', 'read'])->default('unread');
                }
            });
        }
    }

    public function down()
    {
    }
}; 
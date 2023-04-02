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
        Schema::create('telegramlog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('telegramId')->unique();
            $table->string('starterror')->nullable()->default('3');
            $table->string('emailerror')->nullable()->default('3');
            $table->string('passerror')->nullable()->default('3');
            $table->enum('ban', ['1', '0'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegramlog');
    }
};

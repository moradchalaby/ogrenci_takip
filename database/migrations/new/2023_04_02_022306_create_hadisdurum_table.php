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
        Schema::create('hadisdurum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ogrenci_id');
            $table->string('hadis_durum');
            $table->string('hadis_son')->nullable();
            $table->integer('hoca')->nullable();
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
        Schema::dropIfExists('hadisdurum');
    }
};

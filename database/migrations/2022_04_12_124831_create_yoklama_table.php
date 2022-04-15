<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYoklamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yoklama', function (Blueprint $table) {
            $table->id();
            $table->string('yokalma_ad');
            $table->date('yoklama_tarih');
            $table->integer('kullanici_id');
            $table->integer('ders_id');
            $table->integer('sinif_id');
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
        Schema::dropIfExists('yoklama');
    }
}
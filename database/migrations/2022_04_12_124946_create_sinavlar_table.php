<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinavlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinavlar', function (Blueprint $table) {
            $table->id();
            $table->string('sinav_ad')->nullable();;
            $table->date('sinav_zaman')->nullable();;
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
        Schema::dropIfExists('sinavlar');
    }
}

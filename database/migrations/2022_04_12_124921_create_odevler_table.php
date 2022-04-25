<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdevlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odevler', function (Blueprint $table) {
            $table->id();
            $table->string('baslik')->nullable();
            $table->date('zaman')->nullable();;
            $table->date('teslim')->nullable();;
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
        Schema::dropIfExists('odevler');
    }
}

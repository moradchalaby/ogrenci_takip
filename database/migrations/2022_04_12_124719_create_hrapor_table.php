<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHraporTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrapor', function (Blueprint $table) {
            $table->id();
            $table->integer('kullanici_id');
            $table->string('hrapor_sayfa');
            $table->string('hrapor_ders');
            $table->date('hrapor_tarih');
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
        Schema::dropIfExists('hrapor');
    }
}
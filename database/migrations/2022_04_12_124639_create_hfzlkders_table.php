<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHfzlkdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hfzlkders', function (Blueprint $table) {
            $table->id();
            $table->integer('ogrenci_id');
            $table->integer('kullanici_id');
            $table->string('hafizlik_sayfa');
            $table->string('hafizlik_cuz');
            $table->string('hafizlik_topl');
            $table->date('hafizlik_tarih');
            $table->string('hafizlik_hata');
            $table->string('hafizlik_usul');
            $table->string('hafizlik_durum');
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
        Schema::dropIfExists('hfzlkders');
    }
}
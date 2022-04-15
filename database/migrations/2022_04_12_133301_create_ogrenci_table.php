<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOgrenciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ogrenci', function (Blueprint $table) {
            $table->id('ogrenci_id');
            $table->string('ogrenci_adsoyad');
            $table->integer('kullanici_id');
            $table->date('ogrenci_dt')->default('2020-01-01');
            $table->string('ogrenci_tc');
            $table->string('babaad');
            $table->string('annead');
            $table->string('babames');
            $table->string('annemes');
            $table->string('babatel');
            $table->string('annetel');
            $table->text('ogrenci_adres');
            $table->enum('ogrenci_izin', ['0', '1']);
            $table->integer('ogrenci_birim');
            $table->integer('ogrenci_sinif');
            $table->integer('ogrenci_kytdurum');
            $table->string('ogrenci_okuldurum');
            $table->string('ogrenci_resim');
            $table->string('ogrenci_kmlk');
            $table->string('ogrenci_sglk');
            $table->string('ogrenci_belge1');
            $table->string('ogrenci_belge2');
            $table->string('ogrenci_belge3');
            $table->rememberToken();
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
        Schema::dropIfExists('ogrenci');
    }
}
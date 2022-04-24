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
            $table->id('id');
            $table->string('ogrenci_adsoyad');
            $table->integer('kullanici_id')->nullable();
            $table->date('ogrenci_dt')->default('2020-01-01');
            $table->string('ogrenci_tc')->nullable();
            $table->string('babaad')->nullable();
            $table->string('annead')->nullable();
            $table->string('babames')->nullable();
            $table->string('annemes')->nullable();
            $table->string('babatel')->nullable();
            $table->string('annetel')->nullable();
            $table->string('ogrenci_ulke')->nullable();
            $table->string('ogrenci_sehir')->nullable();
            $table->text('ogrenci_adres')->nullable();
            $table->string('ogrenci_resim')->nullable();
            $table->string('ogrenci_kmlk')->nullable();
            $table->string('ogrenci_sglk')->nullable();
            $table->string('ogrenci_belge1')->nullable();
            $table->string('ogrenci_belge2')->nullable();
            $table->string('ogrenci_belge3')->nullable();
            $table->text('ogrenci_aciklama')->nullable();
            $table->integer('ogrenci_yetim')->default(0);
            $table->integer('ogrenci_bosanma')->default(0);
            $table->integer('ogrenci_kytdurum')->nullable()->default(1);
            $table->date('ayrilma_tarih')->nullable();
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
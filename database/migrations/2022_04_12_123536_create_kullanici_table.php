<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKullaniciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kullanici', function (Blueprint $table) {
            $table->id('kullanici_id');
            $table->string('kullanici_adsoyad');
            $table->string('kullanici_mail')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('kullanici_resim');
            $table->string('kullanici_password');
            $table->date('kullanici_dt')->default('2020-01-01');
            $table->string('kullanici_tc');
            $table->string('kullanici_gsm');
            $table->text('kullanici_adres');
            $table->string('kullanici_yetki');
            $table->string('kullanici_birim');
            $table->string('kullanici_sinif');
            $table->string('kullanici_durum');
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
        Schema::dropIfExists('kullanici');
    }
}
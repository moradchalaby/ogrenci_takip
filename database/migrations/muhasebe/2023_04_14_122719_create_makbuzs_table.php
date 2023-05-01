<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakbuzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makbuzs', function (Blueprint $table) {
            $table->bigInteger('id',true,true);
            $table->string('adsoyad', 100);
            $table->string('kullanici', 100);
            $table->unsignedBigInteger('user_id',false);
            $table->unsignedBigInteger('ogrenci_id')->nullable();
            $table->unsignedBigInteger('hoca_id')->nullable();;

            $table->double('tutar');
            $table->string('kur', 100)->default('₺');
            $table->string('odeme_sekli', 100);
            $table->date('tarih');
            $table->string('tur',150);
            $table->text('aciklama')->nullable();;

            $table->timestamps();


            $table->foreign('hoca_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ogrenci_id')->references('id')->on('ogrenci');
        });

        DB::table('makbuzs')->insert([
            ['id' => 3, 'adsoyad' => 'YUSUF ÜÇKARDEŞ', 'user_id'=>1,'kullanici' => 'HALİL İBRAHİM ÖZKUL', 'tutar' => 400, 'kur' => '₺', 'odeme_sekli' => 'Nakit', 'tarih' => '2021-09-03', 'tur'=>'Öğrenci Ödemesi','aciklama' => '1 AYLIK AİDAT BEDELİ'],
            ['id' => 4, 'adsoyad' => 'ELVAN EKREM ŞAHİN','user_id'=>1, 'kullanici' => 'HALİL İBRAHİM ÖZKUL', 'tutar' => 400, 'kur' => '₺', 'odeme_sekli' => 'Nakit', 'tarih' => '2021-09-05', 'tur'=>'Öğrenci Ödemesi','aciklama' => '1 AYLIK AİDAT BEDELİ'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('makbuzs');
    }
}

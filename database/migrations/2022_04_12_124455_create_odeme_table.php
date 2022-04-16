<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odeme', function (Blueprint $table) {
            $table->id('odeme_id');
            $table->integer('ogrenci_id');
            $table->string('ogrenci_adsoyad');
            $table->double('odeme_tutar');
            $table->enum('odeme_kur', ['₺', '€', '$']);
            $table->string('kullanici_name');
            $table->integer('kullanici_id');
            $table->date('odeme_tarih');
            $table->string('odeme_ay');
            $table->integer('odeme_makbuz');
            $table->enum('odeme_sekli', ['BANKA', 'NAKİT']);
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
        Schema::dropIfExists('odeme');
    }
}

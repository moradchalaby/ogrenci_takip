<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakbuzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makbuz', function (Blueprint $table) {
            $table->id();
            $table->string('ad_soyad');
            $table->string('kullanici');
            $table->double('tutar');
            $table->enum('kur', ['₺', '€', '$',]);
            $table->string('odeme_sekli');
            $table->date('tarih');
            $table->text('aciklama');
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
        Schema::dropIfExists('makbuz');
    }
}
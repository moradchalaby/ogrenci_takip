<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasas', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true );
            $table->string('adsoyad', 100);
            $table->string('kullanici', 100);
            $table->unsignedBigInteger('user_id',false);
            $table->unsignedBigInteger('makbuz_id')->nullable();

            $table->double('tutar');
            $table->string('kur', 100)->default('₺');
            $table->string('odeme_sekli', 100)->nullable();;
            $table->date('tarih');
            $table->string('ay', 11);
            $table->string('tur',150);
            $table->text('aciklama')->nullable();
            $table->enum('durum',['1','0'])->default('1');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('makbuz_id')->references('id')->on('makbuzs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hfzlkders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ogrenci_id');
            $table->integer('user_id');
            $table->string('hafizlik_sayfa')->nullable();
            $table->string('hafizlik_cuz')->nullable();
            $table->string('hafizlik_ders', 50)->nullable();
            $table->string('hafizlik_topl')->nullable();
            $table->date('hafizlik_tarih')->nullable();
            $table->string('hafizlik_hata')->nullable();
            $table->string('hafizlik_usul')->nullable();
            $table->string('hafizlik_durum')->nullable();
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
};

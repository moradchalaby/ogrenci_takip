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
        Schema::create('hadisders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ogrenci_id');
            $table->integer('user_id');
            $table->string('hadis_tur')->nullable();
            $table->string('hadis_cuz')->nullable();
            $table->string('hadis_ders', 50)->nullable();
            $table->string('hadis_topl')->nullable();
            $table->date('hadis_tarih')->nullable();
            $table->string('hadis_durum')->nullable();
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
        Schema::dropIfExists('hadisders');
    }
};

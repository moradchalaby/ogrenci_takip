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
        Schema::create('hafizlikdurum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ogrenci_id');
            $table->string('hafizlik_durum');
            $table->date('bast')->nullable();
            $table->date('sont')->nullable();
            $table->string('hafizlik_son')->nullable();
            $table->integer('hoca')->nullable();
            $table->string('donus_suresi')->default('60');
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
        Schema::dropIfExists('hafizlikdurum');
    }
};

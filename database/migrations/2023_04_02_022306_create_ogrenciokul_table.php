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
        Schema::create('ogrenciokul', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ogrenci_id');
            $table->integer('okul_id');
            $table->string('aciklama')->nullable();
            $table->string('basari')->nullable();
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
        Schema::dropIfExists('ogrenciokul');
    }
};

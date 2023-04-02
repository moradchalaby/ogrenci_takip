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
        Schema::create('sinif', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sinif_ad')->nullable();
            $table->integer('user_id');
            $table->integer('sinif_birim')->nullable();
            $table->enum('sinif_durum', ['0', '1'])->default('1');
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
        Schema::dropIfExists('sinif');
    }
};
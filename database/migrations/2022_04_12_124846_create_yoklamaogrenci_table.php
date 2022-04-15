<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYoklamaogrenciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yoklamaogrenci', function (Blueprint $table) {
            $table->id();
            $table->integer('ogrenci_id');
            $table->integer('yoklama_id');
            $table->enum('yoklama_durum', ['0', '1']);
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
        Schema::dropIfExists('yoklamaogrenci');
    }
}
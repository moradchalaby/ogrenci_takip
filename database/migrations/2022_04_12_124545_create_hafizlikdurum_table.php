<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHafizlikdurumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hafizlikdurum', function (Blueprint $table) {
            $table->id();
            $table->integer('ogrenci_id');
            $table->string('ogrenci_adsoyad');
            $table->string('hafizlik_durum');
            $table->date('bast');
            $table->date('sont');
            $table->string('hafizlik_son')->nullable();
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
}

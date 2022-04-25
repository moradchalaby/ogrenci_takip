<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHafizbelgesizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hafizbelgesiz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ogrenci_id');
            $table->unsignedBigInteger('hafizlikdurum_id');
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
        Schema::dropIfExists('hafizbelgesiz');
    }
}
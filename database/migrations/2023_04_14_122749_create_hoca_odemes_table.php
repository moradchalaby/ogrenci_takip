<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHocaOdemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoca_odemes', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true );
            $table->unsignedBigInteger('hoca_id');
            $table->double('tutar');
            $table->string('kur', '100')->default('₺');
            $table->unsignedBigInteger('user_id');
            $table->date('tarih');
            $table->string('ay', 11);
            $table->unsignedBigInteger('makbuz_id');
            $table->string('odeme_sekli', '100')->default('NAKİT');
            $table->timestamps();

            $table->foreign('hoca_id')->references('id')->on('users');
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
        Schema::dropIfExists('hoca_odemes');
    }
}

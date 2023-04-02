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
        Schema::create('yuzune', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('yuzune_ad');
            $table->string('yuzune_tur')->nullable();
            $table->string('yuzune_tur2')->nullable();
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
        Schema::dropIfExists('yuzune');
    }
};

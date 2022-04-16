<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('kullanici_resim')->nullable();
            $table->string('password');
            $table->date('kullanici_dt')->default('2020-01-01');
            $table->string('kullanici_tc')->nullable();
            $table->string('kullanici_gsm')->nullable();
            $table->text('kullanici_adres')->nullable();
            $table->string('kullanici_yetki')->nullable();
            $table->string('kullanici_birim')->nullable();
            $table->string('kullanici_sinif')->nullable();
            $table->string('kullanici_durum')->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
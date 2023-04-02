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
        Schema::create('telegraph_chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('chat_id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('telegraph_bot_id')->index('telegraph_chats_telegraph_bot_id_foreign');
            $table->timestamps();

            $table->unique(['chat_id', 'telegraph_bot_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegraph_chats');
    }
};

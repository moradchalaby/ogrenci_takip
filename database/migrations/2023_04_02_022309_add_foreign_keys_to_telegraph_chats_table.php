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
        Schema::table('telegraph_chats', function (Blueprint $table) {
            $table->foreign(['telegraph_bot_id'])->references(['id'])->on('telegraph_bots')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telegraph_chats', function (Blueprint $table) {
            $table->dropForeign('telegraph_chats_telegraph_bot_id_foreign');
        });
    }
};

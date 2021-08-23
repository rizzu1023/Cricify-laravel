<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMatchPlayersPlayerIdAsInteger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_players', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id')->change();
            $table->unsignedBigInteger('wicket_primary')->change();
            $table->unsignedBigInteger('wicket_secondary')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_players', function (Blueprint $table) {
            $table->string('player_id')->change();
            $table->string('wicket_primary')->change();
            $table->string('wicket_secondary')->change();
        });
    }
}

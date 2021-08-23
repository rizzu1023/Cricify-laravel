<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMatchTracksPlayerIdAsInteger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_tracks', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id')->change();
            $table->unsignedBigInteger('non_striker_id')->change();
            $table->unsignedBigInteger('attacker_id')->change();
            $table->unsignedBigInteger('dismissed_player_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_tracks', function (Blueprint $table) {
            $table->string('player_id')->change();
            $table->string('non_striker_id')->change();
            $table->string('attacker_id')->change();
            $table->string('dismissed_player_id')->change();
        });
    }
}

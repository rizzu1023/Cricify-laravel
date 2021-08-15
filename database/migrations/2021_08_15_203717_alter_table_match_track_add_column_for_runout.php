<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMatchTrackAddColumnForRunout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_tracks', function (Blueprint $table) {
            $table->string('dismissed_player_id')->nullable()->after('wicket_type');
            $table->unsignedTinyInteger('dismissed_at_strike')->default(1)->after('dismissed_player_id');
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
            $table->dropColumn(['dismissed_player_id','dismissed_at_strike']);
        });
    }
}

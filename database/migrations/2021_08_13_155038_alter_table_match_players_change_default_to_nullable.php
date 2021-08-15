<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMatchPlayersChangeDefaultToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_players', function (Blueprint $table) {
            $table->string('wicket_type')->nullable()->default(NULL)->change();
            $table->string('wicket_primary')->nullable()->default(NULL)->change();
            $table->string('wicket_secondary')->default(NULL)->change();
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
            $table->string('wicket_type')->nullable(false)->default('--')->change();
            $table->string('wicket_primary')->nullable(false)->default('--')->change();
            $table->string('wicket_secondary')->default('--')->change();
        });
    }
}

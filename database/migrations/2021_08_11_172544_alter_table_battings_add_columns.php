<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableBattingsAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('battings');
        Schema::create('battings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('player_id')->unique();

            $table->unsignedBigInteger('bt_matches')->default(0);
            $table->unsignedBigInteger('bt_innings')->default(0);
            $table->unsignedBigInteger('bt_runs')->default(0);
            $table->unsignedBigInteger('bt_balls')->default(0);
            $table->unsignedSmallInteger('bt_highest')->default(0);
            $table->decimal('bt_average',5,2)->default(0);
            $table->decimal('bt_sr',5,2)->default(0);
            $table->unsignedBigInteger('bt_notout')->default(0);
            $table->unsignedBigInteger('bt_fours')->default(0);
            $table->unsignedBigInteger('bt_sixes')->default(0);
            $table->unsignedInteger('bt_ducks')->default(0);
            $table->unsignedInteger('bt_fifties')->default(0);
            $table->unsignedInteger('bt_hundreds')->default(0);

            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('battings');
    }
}

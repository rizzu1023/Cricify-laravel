<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableBowlingsAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bowlings');
        Schema::create('bowlings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('player_id')->unique();

            $table->unsignedBigInteger('bw_matches')->default(0);
            $table->unsignedBigInteger('bw_innings')->default(0);
            $table->unsignedBigInteger('bw_runs')->default(0);
            $table->unsignedBigInteger('bw_over')->default(0);
            $table->unsignedTinyInteger('bw_overball')->default(0);
            $table->unsignedSmallInteger('bw_maidens')->default(0);
            $table->unsignedBigInteger('bw_wickets')->default(0);
            $table->decimal('bw_average',5,2)->default(0);
            $table->decimal('bw_economy',5,2)->default(0);
            $table->decimal('bw_sr',5,2)->default(0);
            $table->string('bw_bbi')->default('0-0');
            $table->unsignedBigInteger('bw_4w')->default(0);
            $table->unsignedBigInteger('bw_5w')->default(0);

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
        Schema::dropIfExists('bowlings');
    }
}

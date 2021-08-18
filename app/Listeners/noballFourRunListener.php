<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class noballFourRunListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;

        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = optional($batting_team)->team_id;
        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;

        $batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
        $batsman->bt_runs += 4;
        $batsman->bt_fours += 1;
        $batsman->bt_balls += 1;
        $batsman->update();

        $bowler = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();
        $bowler->bw_runs += 5;
        $bowler->bw_nb += 1;
        $bowler->update();

        $batting_team->score += 5;
        $batting_team->no_ball += 1;
        $batting_team->update();
    }
}

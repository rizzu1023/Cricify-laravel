<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class byesFourRunListener
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
        $batsman->bt_balls += 1;
        $batsman->update();

        $bowler = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();
        $bowler->bw_overball += 1;
        $bowler->update();

        $batting_team->overball += 1;
        $batting_team->score += 4;
        $batting_team->byes += 4;
        $batting_team->update();
    }
}

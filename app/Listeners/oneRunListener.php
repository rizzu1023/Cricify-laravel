<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class oneRunListener
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

        $striker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
        $striker->bt_balls += 1;
        $striker->bt_runs += 1;
        $striker->update();

        $bowler = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();
        $bowler->bw_overball += 1;
        $bowler->bw_runs += 1;
        $bowler->update();

        $batting_team->overball += 1;
        $batting_team->score += 1;
        $batting_team->update();
    }
}

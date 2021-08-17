<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class wideFourRunListener
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
        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;

        $bowler = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();
        $bowler->bw_runs += 5;
        $bowler->bw_wide += 5;
        $bowler->update();

        $batting_team->score += 5;
        $batting_team->wide += 5;
        $batting_team->update();
    }
}

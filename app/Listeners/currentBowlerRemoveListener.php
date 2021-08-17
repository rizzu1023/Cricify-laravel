<?php

namespace App\Listeners;

use App\Events\newOverEvent;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class currentBowlerRemoveListener
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
     * @param  newOverEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;

        $match_detail = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = $match_detail->team_id;

        $current_bowler = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();

        $current_bowler->bw_status = 1;
        $current_bowler->update();
    }
}

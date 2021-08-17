<?php

namespace App\Listeners;

use App\Events\newOverEvent;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class newBowlerSelectListener
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

        $new_bowler = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('player_id',$event->request->newBowler_id)->first();
        $new_bowler->bw_status = 11;
        $new_bowler->update();
    }
}

<?php

namespace App\Listeners;

use App\Events\dotBallEvent;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class bowlerBallUpdateListener
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
     * @param  dotBallEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;

        $match_detail = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = $match_detail->team_id;

        $player = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();
        $player->bw_overball += 1;
        $player->update();
    }
}



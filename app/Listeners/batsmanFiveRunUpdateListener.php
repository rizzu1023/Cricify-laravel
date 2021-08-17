<?php

namespace App\Listeners;

use App\Events\wideFourRunEvent;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class batsmanFiveRunUpdateListener
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
     * @param  wideFourRunEvent  $event
     * @return void
     */
    public function handle($event)
    {

        $match = $event->match;

        $match_detail = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = $match_detail->team_id;

        $player = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
        $player->bt_runs += 5;
        $player->update();
    }
}

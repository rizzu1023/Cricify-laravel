<?php

namespace App\Listeners;

use App\Events\reverseSixRunEvent;
use App\MatchPlayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseBatsmanSixBoundaryUpdateListener
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
     * @param  reverseSixRunEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;

        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = optional($batting_team)->team_id;

        $player = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
        $player->bt_sixes -= 1;
        $player->update();
    }
}

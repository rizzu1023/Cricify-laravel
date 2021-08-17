<?php

namespace App\Listeners;

use App\Events\sixRunEvent;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class batsmanSixBoundaryUpdateListener
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
     * @param  sixRunEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;

        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = optional($batting_team)->team_id;

        $player = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
        $player->bt_sixes += 1;
        $player->update();
    }
}

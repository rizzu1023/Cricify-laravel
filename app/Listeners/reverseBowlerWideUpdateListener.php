<?php

namespace App\Listeners;

use App\Events\reverseWideZeroRunEvent;
use App\MatchPlayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseBowlerWideUpdateListener
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
     * @param  reverseWideZeroRunEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;

        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;

        $player = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();
        $player->bw_wide -= 1;
        $player->update();
    }
}

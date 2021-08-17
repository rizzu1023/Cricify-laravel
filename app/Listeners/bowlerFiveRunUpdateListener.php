<?php

namespace App\Listeners;

use App\Events\wideFourRunEvent;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class bowlerFiveRunUpdateListener
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

        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;

        $player = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();
        $player->bw_runs += 5;
        $player->update();
    }
}

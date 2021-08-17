<?php

namespace App\Listeners;

use App\Events\strikeRotateEvent;
use App\MatchDetail;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class isOverForBowler
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
     * @param  strikeRotateEvent  $event
     * @return void
     */
    public function handle($event)
    {

        $match = $event->match;
        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;
        $attacker = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();

        if ($attacker->bw_overball > 5) {

            $attacker->update([
                'bw_overball' => 0,
                'bw_over' => $attacker->bw_over + 1,
            ]);
        }
    }
}

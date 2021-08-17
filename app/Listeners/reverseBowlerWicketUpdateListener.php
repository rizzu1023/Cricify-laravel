<?php

namespace App\Listeners;

use App\Events\reverseWicketEvent;
use App\MatchPlayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseBowlerWicketUpdateListener
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
     * @param  reverseWicketEvent  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->previous_ball->wicket_type != 'runout') {
            $match = $event->match;
            $bowling_team = $match->MatchDetail->where('isBatting', 0)->first();
            $bowling_team_id = optional($bowling_team)->team_id;

            $current_bowler = $match->MatchPlayers->where('team_id', $bowling_team_id)->where('bw_status', 11)->first();
            $current_bowler->bw_wickets -= 1;
            $current_bowler->update();
        }
    }
}

<?php

namespace App\Listeners;

use App\Events\wicketEvent;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class bowlerWicketUpdateListener
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
     * @param wicketEvent $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->request->wicket_type != 'runout') {

            $match = $event->match;
            $bowling_team = $match->MatchDetail->where('isBatting', 0)->first();
            $bowling_team_id = optional($bowling_team)->team_id;

            $current_bowler = $match->MatchPlayers->where('team_id', $bowling_team_id)->where('bw_status', 11)->first();
            $current_bowler->bw_wickets += 1;
            $current_bowler->update();

        }
    }
}

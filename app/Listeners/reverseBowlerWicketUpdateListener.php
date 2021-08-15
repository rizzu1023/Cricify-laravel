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
            MatchPlayers::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id', $event->request->bw_team_id)
                ->where('bw_status', '11')
                ->decrement('bw_wickets');
        }
    }
}

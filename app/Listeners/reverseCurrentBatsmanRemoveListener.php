<?php

namespace App\Listeners;

use App\Events\reverseWicketEvent;
use App\MatchPlayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseCurrentBatsmanRemoveListener
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
     * @param reverseWicketEvent $event
     * @return void
     */
    public function handle($event)
    {
        $dismissed_batsman = MatchPlayers::where('match_id', $event->request->match_id)
            ->where('tournament_id', $event->request->tournament)
            ->where('team_id', $event->request->bt_team_id)
            ->where('player_id', $event->previous_ball->player_id)->first();

//        if ($event->request->wicket_type == 'bold' || $event->request->wicket_type == 'lbw' || $event->request->wicket_type == 'hitwicket') {
//            $dismissed_batsman->wicket_type = NULL;
//            $dismissed_batsman->wicket_primary = NULL;
//            $dismissed_batsman->bt_balls = $dismissed_batsman->bt_balls - 1;
//            $dismissed_batsman->bt_status = 11;
//            $dismissed_batsman->save();
//        }

//        if ($event->request->wicket_type == 'catch' || $event->request->wicket_type == 'stump') {
            $dismissed_batsman->wicket_type = NULL;
            $dismissed_batsman->wicket_primary = NULL;
            $dismissed_batsman->wicket_secondary = NULL;
            $dismissed_batsman->bt_balls = $dismissed_batsman->bt_balls - 1;
            $dismissed_batsman->bt_status = 11;
            $dismissed_batsman->save();
//        }
    }
}

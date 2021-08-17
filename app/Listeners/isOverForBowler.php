<?php

namespace App\Listeners;

use App\Events\strikeRotateEvent;
use App\MatchPlayers;

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
        $over = MatchPlayers::where('match_id', $event->request->match_id)
            ->where('tournament_id', $event->request->tournament)
            ->where('team_id', $event->request->bw_team_id)
            ->where('player_id', $event->request->attacker_id)->first();

        if ($over->bw_overball > 5) {

            $over->update([
                'bw_overball' => 0,
                'bw_over' => $over->bw_over + 1,
            ]);


        }
    }
}

<?php

namespace App\Listeners;

use App\Events\startInningEvent;

class startInningListener
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
     * @param  startInningEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = optional($batting_team)->team_id;
        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;

        $striker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id',$event->request->strike_id)->first();
        $striker->bt_status = 11;
        $striker->bt_order = 1;
        $striker->update();

        $non_striker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id',$event->request->nonstrike_id)->first();
        $non_striker->bt_status = 10;
        $non_striker->bt_order = 2;
        $non_striker->update();

        $attacker = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('player_id',$event->request->attacker_id)->first();
        $attacker->bw_status = 11;
        $attacker->update();

        $match->status += 1;
        $match->update();
    }
}

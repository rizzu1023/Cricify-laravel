<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class wicketListener
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
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;

        $batting_team = $match->MatchDetail->where('isBatting', 1)->first();
        $batting_team_id = optional($batting_team)->team_id;
        $bowling_team = $match->MatchDetail->where('isBatting', 0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;

        $current_batsman = $match->MatchPlayers->where('team_id', $batting_team_id)->where('bt_status', 11)->first();

        if ($event->request->wicket_type == 'bold' || $event->request->wicket_type == 'lbw' || $event->request->wicket_type == 'hitwicket') {
            $current_batsman->wicket_type = $event->request->wicket_type;
            $current_batsman->wicket_primary = $event->request->attacker_id;
            $current_batsman->bt_balls = $current_batsman->bt_balls + 1;
            $current_batsman->bt_status = 0;
            $current_batsman->update();
        } elseif ($event->request->wicket_type == 'catch' || $event->request->wicket_type == 'stump') {
            $current_batsman->wicket_type = $event->request->wicket_type;
            $current_batsman->wicket_primary = $event->request->attacker_id;
            $current_batsman->wicket_secondary = $event->request->wicket_secondary;
            $current_batsman->bt_balls = $current_batsman->bt_balls + 1;
            $current_batsman->bt_status = 0;
            $current_batsman->update();
        }


        $highest_batting_order = $match->MatchPlayers->where('team_id', $batting_team_id)->where('bt_order', '<', 100)->sortByDesc('bt_order')->first()->bt_order;

        $new_batsman = $match->MatchPlayers->where('team_id', $batting_team_id)->where('player_id', $event->request->newBatsman_id)->first();
        $new_batsman->bt_status = 11;
        $new_batsman->bt_order = $highest_batting_order + 1;
        $new_batsman->update();

        if ($event->request->isBatsmanCross) {

            $nonstriker_batsman = $match->MatchPlayers->where('team_id', $batting_team_id)->where('bt_status', 10)->first();
            $nonstriker_batsman->bt_status = 11;
            $nonstriker_batsman->update();

            $striker_batsman = $match->MatchPlayers->where('team_id', $batting_team_id)->where('player_id', $event->request->newBatsman_id)->first();
            $striker_batsman->bt_status = 10;
            $striker_batsman->update();
        }

        $bowler = $match->MatchPlayers->where('team_id', $bowling_team_id)->where('bw_status', 11)->first();
        $bowler->bw_overball += 1;
        $bowler->bw_wickets += 1;
        $bowler->update();

        $batting_team->overball += 1;
        $batting_team->wicket += 1;
        $batting_team->update();
    }
}

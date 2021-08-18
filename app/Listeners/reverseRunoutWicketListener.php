<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseRunoutWicketListener
{
    public function __construct()
    {
    }

    public function handle($event)
    {
        $match = $event->match;
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = optional($batting_team)->team_id;
        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;

        $striker_batsman =  $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
        $nonstriker_batsman =  $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',10)->first();

        $dismissed_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->previous_ball->dismissed_player_id)->first();

        $last_ball_played_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->previous_ball->player_id)->first();
        $last_ball_non_striker_batsman = $match->MatchPlayers->where('team_id', $batting_team_id)->where('player_id', $event->previous_ball->non_striker_id)->first();

        $attacker = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();

        if ($event->previous_ball->dismissed_at_strike) {

            $striker_batsman->bt_status = 'DNB';
            $striker_batsman->bt_order = 100;
            $striker_batsman->bt_runs = 0;
            $striker_batsman->bt_balls = 0;
            $striker_batsman->bt_fours = 0;
            $striker_batsman->bt_sixes = 0;

            if ($dismissed_batsman->id == $last_ball_played_batsman->id) {
                $last_ball_non_striker_batsman->bt_status = 10;
                $dismissed_batsman->bt_status = 11;
            }
            else{
                $last_ball_played_batsman->bt_status = 11;
                $dismissed_batsman->bt_status = 10;
            }
        } else {

            $nonstriker_batsman->bt_status = 'DNB';
            $nonstriker_batsman->bt_order = 100;
            $nonstriker_batsman->bt_runs = 0;
            $nonstriker_batsman->bt_balls = 0;
            $nonstriker_batsman->bt_fours = 0;
            $nonstriker_batsman->bt_sixes = 0;

            if ($dismissed_batsman->id == $last_ball_played_batsman->id) {
                $last_ball_non_striker_batsman->bt_status = 10;
                $dismissed_batsman->bt_status = 11;
            }
            else{
                $dismissed_batsman->bt_status = 10;
                $last_ball_played_batsman->bt_status = 11;
            }
        }

        $dismissed_batsman->wicket_type = 'NULL';
        $dismissed_batsman->wicket_primary = 'NULL';
        $dismissed_batsman->wicket_secondary = 'NULL';

        $last_ball_played_batsman->bt_runs -= $event->previous_ball->run;
        $last_ball_played_batsman->bt_balls -= 1;
        $last_ball_played_batsman->update();

        $striker_batsman->update();
        $nonstriker_batsman->update();
        $dismissed_batsman->update();
        $last_ball_non_striker_batsman->update();

        $attacker->bw_runs -= $event->previous_ball->run;
        $attacker->bw_overball -= 1;
        $attacker->update();

        $batting_team->score -= $event->previous_ball->run;
        $batting_team->overball -= 1;
        $batting_team->wicket -= 1;
        $batting_team->update();
    }
}

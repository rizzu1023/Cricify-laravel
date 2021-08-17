<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseWicketListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = optional($batting_team)->team_id;
        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;

        $nonstriker_batsman =  $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',10)->first();
        $striker_batsman =  $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();


        if ($event->previous_ball->wicket_type == 'runout') {
            if($event->previous_ball->dismissed_at_strike == 1){
                $striker_batsman->bt_status = 'DNB';
                $striker_batsman->bt_order = 100;
                $striker_batsman->bt_runs = 0;
                $striker_batsman->bt_balls = 0;
                $striker_batsman->bt_fours = 0;
                $striker_batsman->bt_sixes = 0;
                $striker_batsman->update();
            }
            else{
                $nonstriker_batsman->bt_status = 'DNB';
                $nonstriker_batsman->bt_order = 100;
                $nonstriker_batsman->bt_runs = 0;
                $nonstriker_batsman->bt_balls = 0;
                $nonstriker_batsman->bt_fours = 0;
                $nonstriker_batsman->bt_sixes = 0;
                $nonstriker_batsman->update();
            }

            $batting_team->score = $batting_team->score - $event->previous_ball->run;
            $batting_team->update();

            $dismissed_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->previous_ball->dismissed_player_id)->first();

            $dismissed_batsman->wicket_type = NULL;
            $dismissed_batsman->wicket_primary = NULL;
            $dismissed_batsman->wicket_secondary = NULL;

            $last_ball_played_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->previous_ball->player_id)->first();

            $last_ball_played_batsman->bt_balls = $last_ball_played_batsman->bt_balls - 1;
            $last_ball_played_batsman->bt_runs = $last_ball_played_batsman->bt_runs - $event->previous_ball->run;

            $last_ball_non_striker_batsman = $match->MatchPlayers->where('team_id', $batting_team_id)->where('player_id', $event->previous_ball->non_striker_id)->first();

            if ($event->previous_ball->dismissed_at_strike) {
                if ($dismissed_batsman->id == $last_ball_played_batsman->id) {
                    $last_ball_non_striker_batsman->bt_status = 10;
                    $dismissed_batsman->bt_status = 11;
                }
                else{
                    $last_ball_played_batsman->bt_status = 11;
                    $dismissed_batsman->bt_status = 10;
                }
            } else {
                if ($dismissed_batsman->id == $last_ball_played_batsman->id) {
                    $last_ball_non_striker_batsman->bt_status = 10;
                    $dismissed_batsman->bt_status = 11;
                }
                else{
                    $dismissed_batsman->bt_status = 10;
                    $last_ball_played_batsman->bt_status = 11;

                }
            }
            $last_ball_played_batsman->update();
            $dismissed_batsman->update();
            $last_ball_non_striker_batsman->update();
        }
        else{

            if ($event->previous_ball->batsman_cross) {

                if($nonstriker_batsman) {
                    $nonstriker_batsman->bt_status = 'DNB';
                    $nonstriker_batsman->bt_order = 100;
                    $nonstriker_batsman->bt_runs = 0;
                    $nonstriker_batsman->bt_balls = 0;
                    $nonstriker_batsman->bt_fours = 0;
                    $nonstriker_batsman->bt_sixes = 0;
                    $nonstriker_batsman->update();
                }

                if ($striker_batsman) {
                    $striker_batsman->bt_status = 10;
                    $striker_batsman->update();
                }
            } else {
                if ($striker_batsman) {
                    $striker_batsman->bt_status = 'DNB';
                    $striker_batsman->bt_order = 100;
                    $striker_batsman->bt_runs = 0;
                    $striker_batsman->bt_balls = 0;
                    $striker_batsman->bt_fours = 0;
                    $striker_batsman->bt_sixes = 0;
                    $striker_batsman->update();
                }
            }

            $dismissed_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->previous_ball->player_id)->first();

            $dismissed_batsman->wicket_type = NULL;
            $dismissed_batsman->wicket_primary = NULL;
            $dismissed_batsman->wicket_secondary = NULL;
            $dismissed_batsman->bt_balls = $dismissed_batsman->bt_balls - 1;
            $dismissed_batsman->bt_status = 11;
            $dismissed_batsman->update();
        }


        $current_bowler = $match->MatchPlayers->where('team_id', $bowling_team_id)->where('bw_status', 11)->first();
        if($event->previous_ball->wicket_type != 'runout'){
            $current_bowler->bw_wickets -= 1;
        }
        $current_bowler->bw_overball -= 1;
        $current_bowler->update();

        $batting_team->overball -= 1;
        $batting_team->wicket -= 1;
        $batting_team->update();
    }
}

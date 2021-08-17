<?php

namespace App\Listeners;

use App\Events\reverseWicketEvent;
use App\MatchDetail;
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
        $match = $event->match;

        $batting_team = $match->MatchDetail->where('isBatting', 1)->first();
        $batting_team_id = optional($batting_team)->team_id;


        if ($event->previous_ball->wicket_type == 'runout') {

            $batting_team->score = $batting_team->score - $event->previous_ball->run;
            $batting_team->update();

            $dismissed_batsman = $match->MatchPlayers->where('team_id', $batting_team_id)->where('player_id', $event->previous_ball->dismissed_player_id)->first();

            $dismissed_batsman->wicket_type = NULL;
            $dismissed_batsman->wicket_primary = NULL;
            $dismissed_batsman->wicket_secondary = NULL;

            $last_ball_played_batsman = $match->MatchPlayers->where('team_id', $batting_team_id)->where('player_id', $event->previous_ball->player_id)->first();

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


        } else {
            $dismissed_batsman = $match->MatchPlayers->where('team_id', $batting_team_id)->where('player_id', $event->previous_ball->player_id)->first();

            $dismissed_batsman->wicket_type = NULL;
            $dismissed_batsman->wicket_primary = NULL;
            $dismissed_batsman->wicket_secondary = NULL;
            $dismissed_batsman->bt_balls = $dismissed_batsman->bt_balls - 1;
            $dismissed_batsman->bt_status = 11;
            $dismissed_batsman->update();

        }


    }
}

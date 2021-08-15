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
        if ($event->previous_ball->wicket_type == 'runout') {
            $batting_team = MatchDetail::where('match_id',$event->request->match_id)
                ->where('team_id',$event->request->bt_team_id)
                ->where('tournament_id', $event->request->tournament)
                ->first();
            $batting_team->score = $batting_team->score - $event->previous_ball->run;
            $batting_team->update();
            
            $dismissed_batsman = MatchPlayers::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id', $event->request->bt_team_id)
                ->where('player_id', $event->previous_ball->dismissed_player_id)->first();

            $dismissed_batsman->wicket_type = NULL;
            $dismissed_batsman->wicket_primary = NULL;
            $dismissed_batsman->wicket_secondary = NULL;

            $last_ball_played_batsman = MatchPlayers::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id', $event->request->bt_team_id)
                ->where('player_id', $event->previous_ball->player_id)->first();

            $last_ball_played_batsman->bt_balls = $last_ball_played_batsman->bt_balls - 1;
            $last_ball_played_batsman->bt_runs = $last_ball_played_batsman->bt_runs - $event->previous_ball->run;

            if($event->previous_ball->dismissed_at_strike){
                $dismissed_batsman->bt_status = 11;
                $last_ball_played_batsman->bt_status = 10;
            }
            else{
                $dismissed_batsman->bt_status = 10;
                $last_ball_played_batsman->bt_status = 11;
            }
            $dismissed_batsman->update();
            $last_ball_played_batsman->update();


        }
        else{
            $dismissed_batsman = MatchPlayers::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id', $event->request->bt_team_id)
                ->where('player_id', $event->previous_ball->player_id)->first();

            $dismissed_batsman->wicket_type = NULL;
            $dismissed_batsman->wicket_primary = NULL;
            $dismissed_batsman->wicket_secondary = NULL;
            $dismissed_batsman->bt_balls = $dismissed_batsman->bt_balls - 1;
            $dismissed_batsman->bt_status = 11;
            $dismissed_batsman->update();

        }



    }
}

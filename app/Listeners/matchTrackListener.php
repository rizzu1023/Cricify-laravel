<?php

namespace App\Listeners;

use App\MatchDetail;
use App\MatchTrack;
use App\MatchPlayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class matchTrackListener
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
        $match_detail = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = $match_detail->team_id;
        $bowling_team_id = $match->MatchDetail->where('isBatting',0)->first()->team_id;


        $action = '--';
        $run = 0;
        $wicket = 0;
        $wicket_type = NULL;
        $dismissed_player_id = NULL;
        $dismissed_at_strike = 1;
        $batsman_cross = 0;
        if ($event->request->value == '8') {
            $action = 'zero';
            $run = 0;
        } elseif ($event->request->value == '1') {
            $action = 'one';
            $run = 1;
        } elseif ($event->request->value == '2') {
            $action = 'two';
            $run = 2;
        } elseif ($event->request->value == '3') {
            $action = 'three';
            $run = 3;
        } elseif ($event->request->value == '4') {
            $action = 'four';
            $run = 4;
        } elseif ($event->request->value == '5') {
            $action = 'five';
            $run = 5;
        } elseif ($event->request->value == '6') {
            $action = 'six';
            $run = 6;
        } elseif ($event->request->value == 'wd') {
            $action = 'wd';
            $run = 1;
        } elseif ($event->request->value == 'wd1') {
            $action = 'wd1';
            $run = 2;
        } elseif ($event->request->value == 'wd2') {
            $action = 'wd2';
            $run = 3;
        } elseif ($event->request->value == 'wd3') {
            $action = 'wd3';
            $run = 4;
        } elseif ($event->request->value == 'wd4') {
            $action = 'wd4';
            $run = 5;
        } elseif ($event->request->value == 'b1') {
            $action = 'b1';
            $run = 1;
        } elseif ($event->request->value == 'b2') {
            $action = 'b2';
            $run = 2;
        } elseif ($event->request->value == 'b3') {
            $action = 'b3';
            $run = 3;
        } elseif ($event->request->value == 'b4') {
            $action = 'b4';
            $run = 4;
        } elseif ($event->request->value == 'lb1') {
            $action = 'lb1';
            $run = 1;
        } elseif ($event->request->value == 'lb2') {
            $action = 'lb2';
            $run = 2;
        } elseif ($event->request->value == 'lb3') {
            $action = 'lb3';
            $run = 3;
        } elseif ($event->request->value == 'lb4') {
            $action = 'lb4';
            $run = 4;
        } elseif ($event->request->value == 'nb') {
            $action = 'nb';
            $run = 1;
        } elseif ($event->request->value == 'nb1') {
            $action = 'nb1';
            $run = 2;
        } elseif ($event->request->value == 'nb2') {
            $action = 'nb2';
            $run = 3;
        } elseif ($event->request->value == 'nb3') {
            $action = 'nb3';
            $run = 4;
        } elseif ($event->request->value == 'nb4') {
            $action = 'nb4';
            $run = 5;
        } elseif ($event->request->value == 'nb5') {
            $action = 'nb5';
            $run = 6;
        } elseif ($event->request->value == 'nb6') {
            $action = 'nb6';
            $run = 7;
        } elseif ($event->request->value == 'rh') {
            $action = 'rh';
            $run = 0;
        } elseif ($event->request->wicket_type == 'runout') {
            $wicket = 1;
            $action = 'wicket';
            $run = $event->request->run_scored;
            $wicket_type = $event->request->wicket_type;
            $dismissed_player_id = $event->request->batsman_runout;
            $dismissed_at_strike = $event->request->where_batsman_runout == 'strike' ? 1 : 0;
        } elseif ($event->request->wicket_type == 'lbw' || $event->request->wicket_type == 'bold' || $event->request->wicket_type == 'catch' || $event->request->wicket_type == 'hitwicket' || $event->request->wicket_type == 'stump') {
            $action = 'wicket';
            $wicket = 1;
            $run = 0;
            $wicket_type = $event->request->wicket_type;

            if ($event->request->isBatsmanCross) {
                $batsman_cross = 1;
                //update
            }
        }

        $striker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
        $non_striker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',10)->first();
        $attacker = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();


            if ($match_detail) {
                MatchTrack::create([
                    'match_id' => $match->match_id,
                    'team_id' => $match_detail->team_id,
                    'player_id' => $striker->player_id,
                    'attacker_id' => $attacker->player_id,
                    'non_striker_id' => $non_striker->player_id,
                    'score' => $match_detail->score + $run,
                    'wickets' => $match_detail->wicket + $wicket,
                    'action' => $action,
                    'wicket_type' => $wicket_type,
                    'dismissed_player_id' => $dismissed_player_id,
                    'dismissed_at_strike' => $dismissed_at_strike,
                    'run' => $run,
                    'over' => $match_detail->over,
                    'overball' => $match_detail->overball,
                    'batsman_cross' => $batsman_cross,
                    'tournament_id' => $match->tournament_id,
                ]);
            }
        }
}

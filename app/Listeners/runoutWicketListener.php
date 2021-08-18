<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class runoutWicketListener
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


        $highest_batting_order = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_order','<',100)->sortByDesc('bt_order')->first()->bt_order;

        $got_out_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->request->batsman_runout)->first();
        $new_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->request->newBatsman_id)->first();

        $striker_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
        $non_striker_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',10)->first();

        $attacker = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();


        $got_out_batsman->bt_status = 0;
        $got_out_batsman->wicket_type = 'runout';
        $got_out_batsman->bt_status = $event->request->wicket_primary;
        $got_out_batsman->bt_status = $event->request->wicket_secondary ? $event->request->wicket_secondary : NULL;

        if($event->request->where_batsman_runout == 'strike'){
            if($got_out_batsman->id == $striker_batsman->id){
                $new_batsman->bt_status = 11;
            }
            else{
                $striker_batsman->bt_status = 10;
                $new_batsman->bt_status = 11;
            }
        }
        else{
            if($got_out_batsman->id == $striker_batsman->id){
                $new_batsman->bt_status = 10;
                $non_striker_batsman->bt_status = 11;
            }
            else{
                $new_batsman->bt_status = 10;
            }
        }

        $striker_batsman->bt_runs += $event->request->run_scored;
        $striker_batsman->bt_balls += 1;
        $striker_batsman->update();

        $got_out_batsman->update();

        $new_batsman->bt_order = $highest_batting_order;
        $new_batsman->update();

        $non_striker_batsman->update();

        $attacker->bw_runs += $event->request->run_scored;
        $attacker->bw_overball += 1;
        $attacker->update();

        $batting_team->score += $event->request->run_scored;
        $batting_team->overball += 1;
        $batting_team->wicket += 1;
        $batting_team->update();
    }
}

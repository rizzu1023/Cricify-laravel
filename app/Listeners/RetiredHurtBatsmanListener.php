<?php

namespace App\Listeners;

use App\Events\RetiredHurtBatsmanEvent;
use App\MatchPlayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RetiredHurtBatsmanListener
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
     * @param  RetiredHurtBatsmanEvent  $event
     * @return void
     */
    public function handle(RetiredHurtBatsmanEvent $event)
    {
        $match = $event->match;
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = optional($batting_team)->team_id;


        $retired_hurt_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->request->retiredHurtBatsman_id)->first();
        $new_batsman = $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->request->newBatsman_id)->first();
        $highest_batting_order = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_order','<',100)->sortByDesc('bt_order')->first()->bt_order;

        $strike_status = $retired_hurt_batsman->bt_status;
        $retired_hurt_batsman->bt_status = 12;
        $retired_hurt_batsman->update();

        if($strike_status == 10){
            $new_batsman->bt_status = 10;
        }
        else{
            $new_batsman->bt_status = 11;
        }

        $new_batsman->bt_order = $highest_batting_order + 1;
        $new_batsman->update();
    }
}

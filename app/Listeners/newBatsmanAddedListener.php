<?php

namespace App\Listeners;

use App\Events\wicketEvent;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class newBatsmanAddedListener
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
     * @param wicketEvent $event
     * @return void
     */
    public function handle($event)
    {



        if ($event->request->wicket_type != 'runout') {
            $match = $event->match;

            $batting_team = $match->MatchDetail->where('isBatting',1)->first();
            $batting_team_id = optional($batting_team)->team_id;

            $highest_batting_order = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_order','<',100)->sortByDesc('bt_order')->first()->bt_order;

            $new_batsman =  $match->MatchPlayers->where('team_id',$batting_team_id)->where('player', $event->request->newBatsman_id)->first();
            $new_batsman->bt_status = 11;
            $new_batsman->bt_order = $highest_batting_order + 1;
            $new_batsman->update();

            if ($event->request->isBatsmanCross) {

                $nonstriker_batsman =  $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',10)->first();
                $nonstriker_batsman->bt_status = 11;
                $nonstriker_batsman->update();

                $striker_batsman =  $match->MatchPlayers->where('team_id',$batting_team_id)->where('player_id', $event->request->newBatsman_id)->first();
                $striker_batsman->bt_status = 10;
                $striker_batsman->update();
            }
        }

    }
}

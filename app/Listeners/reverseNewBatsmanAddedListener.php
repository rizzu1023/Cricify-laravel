<?php

namespace App\Listeners;

use App\Events\reverseWicketEvent;
use App\MatchPlayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseNewBatsmanAddedListener
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

        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = optional($batting_team)->team_id;

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
        }
    }
}

<?php

namespace App\Listeners;

use App\Events\reverseOneRunEvent;
use App\MatchPlayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseIsOverForBowler
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
     * @param  reverseOneRunEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;
        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $bowling_team_id = optional($bowling_team)->team_id;
        $attacker = $match->MatchPlayers->where('team_id',$bowling_team_id)->where('bw_status',11)->first();



        if ($attacker->bw_overball == 0) {

            if($attacker->bw_over == 0){
                $attacker->bw_status = 'DNB';
            }
            else{
                $attacker->bw_status = 1;
            }
            $attacker->update();

            $previous_bowler = $match->MatchPlayers->where('player_id',$event->previous_ball->attacker_id)->first();

            $previous_bowler->bw_status = 11;
            $previous_bowler->bw_overball = 6;
            $previous_bowler->bw_over = $previous_bowler->bw_over - 1;
            $previous_bowler->update();

        }
    }
}

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
        $current_bowler = MatchPlayers::where('match_id', $event->request->match_id)
            ->where('tournament_id', $event->request->tournament)
            ->where('team_id', $event->request->bw_team_id)
            ->where('bw_status',11)->first();



        if ($current_bowler->bw_overball == 0) {

            if($current_bowler->bw_over == 0){
                $current_bowler->bw_status = 'DNB';
            }
            else{
                $current_bowler->bw_status = 1;
            }
            $current_bowler->save();


            $previous_bowler = MatchPlayers::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id', $event->request->bw_team_id)
                ->where('player_id', $event->previous_ball->attacker_id)->first();

            $previous_bowler->bw_status = 11;
            $previous_bowler->bw_overball = 6;
            $previous_bowler->bw_over = $previous_bowler->bw_over - 1;
            $previous_bowler->update();

//            MatchPlayers::where('match_id', $event->request->match_id)
//                ->where('tournament_id', $event->request->tournament)
//                ->where('team_id', $event->request->bw_team_id)
//                ->where('player_id', $event->request->attacker_id)
//                ->update(['bw_overball' => 0]);
//
//            MatchPlayers::where('match_id', $event->request->match_id)
//                ->where('tournament_id', $event->request->tournament)
//                ->where('team_id', $event->request->bw_team_id)
//                ->where('player_id', $event->request->attacker_id)
//                ->increment('bw_over');

        }
    }
}

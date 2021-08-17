<?php

namespace App\Listeners;

use App\Events\strikeRotateEvent;
use App\MatchDetail;
use App\Game;
use App\MatchPlayers;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class isOverForTeam
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
     * @param strikeRotateEvent $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = $batting_team->team_id;


        if ($batting_team->overball > 5) {
            $batting_team->update([
                'overball' => 0,
                'over' => $batting_team->over + 1,
                'isOver' => 1,
            ]);


            $striker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11);
            $nonstriker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',10);

            DB::transaction(function() use ($nonstriker,$striker){
                $nonstriker->update(['bt_status' => 11]);
                $striker->update(['bt_status' => 10]);
            });
        }
    }
}

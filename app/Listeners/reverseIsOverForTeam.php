<?php

namespace App\Listeners;

use App\Events\reverseOneRunEvent;
use App\MatchDetail;
use App\MatchPlayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class reverseIsOverForTeam
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
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = $batting_team->team_id;


        if ($batting_team->overball == 0) {

            $batting_team->overball = 6;
            $batting_team->over -= 1;
            $batting_team->update();

            $striker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
            $nonstriker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',10)->first();

            DB::transaction(function() use ($nonstriker,$striker){
                $nonstriker->update(['bt_status' => 11]);
                $striker->update(['bt_status' => 10]);
            });
        }
    }
}

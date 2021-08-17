<?php

namespace App\Listeners;

use App\Events\strikeRotateEvent;
use App\MatchPlayers;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\Psr7\str;

class  strikeRotateListener
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

//        $query = MatchPlayers::where('match_id', $event->request->match_id)
//            ->where('tournament_id', $event->request->tournament)
//            ->where('team_id', $event->request->bt_team_id)
//            ->whereIn('bt_status', [10, 11])->get();

        $nonstriker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',11)->first();
        $striker = $match->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status',10)->first();


        DB::transaction(function () use ($nonstriker, $striker) {
            $nonstriker->bt_status = 11;
            $nonstriker->update();
            $striker->bt_status = 10;
            $striker->update();
        });


    }
}

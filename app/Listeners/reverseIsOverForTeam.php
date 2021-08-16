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
        $over = MatchDetail::where('match_id', $event->request->match_id)
            ->where('tournament_id', $event->request->tournament)
            ->where('team_id', $event->request->bt_team_id)->first();



        if ($over->overball == 0) {
            $over->update([
                'overball' => 6,
                'over' => $over->over - 1,
            ]);



            //strike Rotation

            $query = MatchPlayers::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id', $event->request->bt_team_id)
                ->whereIn('bt_status', [10,11])->get();

            $nonstriker = $query->where('bt_status', 10)->first();

            $striker = $query->where('bt_status', 11)->first();

            DB::transaction(function() use ($nonstriker,$striker){
                $nonstriker->update(['bt_status' => 11]);
                $striker->update(['bt_status' => 10]);
            });
        }
    }
}

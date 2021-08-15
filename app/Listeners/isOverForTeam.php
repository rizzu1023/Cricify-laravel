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
        $over = MatchDetail::where('match_id', $event->request->match_id)
            ->where('tournament_id', $event->request->tournament)
            ->where('team_id', $event->request->bt_team_id)->first();


        if ($over->overball > 5) {
            $over->update([
                'overball' => 0,
                'over' => $over->over + 1,
                'isOver' => 1,
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

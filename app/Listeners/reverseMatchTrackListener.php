<?php

namespace App\Listeners;

use App\Events\reverseOneRunEvent;
use App\MatchTrack;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseMatchTrackListener
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
        $last_ball = MatchTrack::where('team_id',$event->request->bt_team_id)
            ->where('match_id',$event->request->match_id)
            ->where('tournament_id',$event->request->tournament)
            ->orderBy('over','desc')
            ->orderBy('overball','desc')
            ->orderBy('created_at','desc')
            ->first();

        $last_ball->delete();
    }
}

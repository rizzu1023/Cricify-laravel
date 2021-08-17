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
        $match = $event->match;
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $batting_team_id = optional($batting_team)->team_id;

        $last_ball = MatchTrack::where('team_id',$batting_team_id)
            ->where('match_id',$match->match_id)
            ->where('tournament_id',$match->tournament_id)
            ->orderBy('over','desc')
            ->orderBy('overball','desc')
            ->orderBy('created_at','desc')
            ->first();

        $last_ball->delete();
    }
}

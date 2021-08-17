<?php

namespace App\Listeners;

use App\Events\reverseNoballZeroRunEvent;
use App\MatchDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseTeamOneNoballUpdateListener
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
     * @param  reverseNoballZeroRunEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();

        $batting_team->no_ball -= 1;
        $batting_team->update();
    }
}

<?php

namespace App\Listeners;

use App\Events\reverseSixRunEvent;
use App\MatchDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseTeamSixRunUpdateListener
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
     * @param  reverseSixRunEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();

        $batting_team->score -= 6;
        $batting_team->update();
    }
}

<?php

namespace App\Listeners;

use App\Events\threeRunEvent;
use App\MatchDetail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class teamThreeRunUpdateListener
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
     * @param  threeRunEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;
        $batting_team = $match->MatchDetail->where('isBatting',1)->first();

        $batting_team->score += 3;
        $batting_team->update();
    }
}

<?php

namespace App\Listeners;

use App\Events\reverseEndInningEvent;
use App\Game;
use App\Jobs\ReverseUpdatePointsTableJob;
use App\MatchDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class reverseEndInningListener
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
     * @param reverseEndInningEvent $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;


        if($match->status == 2 || $match->status = 4){
            $match->status -= 1;
            $match->won = 0;
            $match->mom = NULL;
            $match->description = NULL;
            $match->update();

            if ($match->status == 1) {
                $batting_team = $match->MatchDetail->where('isBatting',1)->first();
                $bowling_team = $match->MatchDetail->where('isBatting',0)->first();

                $batting_team->isBatting = 0;
                $bowling_team->isBatting = 1;
                $batting_team->update();
                $bowling_team->update();
            }

            if ($match->status == 3) {
                ReverseUpdatePointsTableJob::dispatch($match);
            }
        }



    }
}

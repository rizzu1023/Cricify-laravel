<?php

namespace App\Listeners;

use App\Game;
use App\Jobs\UpdatePointsTableJob;
use App\MatchDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class endInningListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $match = $event->match;
        $match->status += 1;
        $match->update();

        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();

        if($match->status == 2){

            $batting_team->isBatting = 0;
            $bowling_team->isBatting = 1;
            $batting_team->update();
            $bowling_team->update();

        }
        if($match->status == 4){

            if($batting_team->score > $bowling_team->score){
                $wickets = 10 - $batting_team->wicket;
                $match->won = $batting_team->team_id;
                $result = "won by $wickets wickets";
                $match->description = $result;
            }
            else if($batting_team->score < $bowling_team->score){
                $runs = $bowling_team->score - $batting_team->score;
                $match->won = $bowling_team->team_id;
                $result = "won by $runs runs";
                $match->description = $result;
            }
            else{
                $match->won = 0;
                $match->description = "Match Draw";
            }
            $match->update();

            UpdatePointsTableJob::dispatch($match);
        }
    }
}

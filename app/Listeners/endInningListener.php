<?php

namespace App\Listeners;

use App\Game;
use App\Jobs\CalculateNRRJob;
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
        $match1 = Game::where('match_id',$event->request->match_id)
            ->where('tournament_id',$event->request->tournament)
            ->increment('status');

        $match = Game::where('match_id',$event->request->match_id)->first();

        if($match->status == 2){
            $inning1 = MatchDetail::where('match_id',$event->request->match_id)
                ->where('tournament_id',$event->request->tournament)
                ->where('isBatting',1)
                ->first();

            $inning0 = MatchDetail::where('match_id',$event->request->match_id)
                ->where('tournament_id',$event->request->tournament)
                ->where('isBatting',0)
                ->first();


            $inning1->isBatting = 0;
            $inning0->isBatting = 1;
            $inning1->update();
            $inning0->update();

        }
        if($match->status == 4){
            $inning1 = MatchDetail::where('match_id',$event->request->match_id)
                ->where('tournament_id',$event->request->tournament)
                ->where('isBatting',1)
                ->first();

            $inning0 = MatchDetail::where('match_id',$event->request->match_id)
                ->where('tournament_id',$event->request->tournament)
                ->where('isBatting',0)
                ->first();


            if($inning1->score > $inning0->score){
                $wickets = 10 - $inning1->wicket;
                $match->won = $inning1->team_id;
                $result = "won by $wickets wickets";
                $match->description = $result;
            }
            else if($inning1->score < $inning0->score){
                $runs = $inning0->score - $inning1->score;
                $match->won = $inning0->team_id;
                $result = "won by $runs runs";
                $match->description = $result;
            }
            else{
                $match->won = 0;
                $match->description = "Match Draw";
            }
            $match->update();

            $inning1->isBatting = 0;
            $inning1->update();

            CalculateNRRJob::dispatch($event->request->match_id);
        }
    }
}

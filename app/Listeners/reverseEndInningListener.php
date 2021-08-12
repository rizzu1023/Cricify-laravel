<?php

namespace App\Listeners;

use App\Events\reverseEndInningEvent;
use App\Game;
use App\Jobs\ReverseCalculateNRRJob;
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
        $game = Game::where('match_id', $event->request->match_id)
            ->where('tournament_id', $event->request->tournament)
            ->first();

        $game->status = $game->status - 1;
        $game->mom = '--';
        $game->update();

        $match = Game::where('match_id',$event->request->match_id)->first();
        if ($match->status == 1) {
            $inning1 = MatchDetail::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('isBatting', 1)
                ->first();

            $inning0 = MatchDetail::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('isBatting', 0)
                ->first();

            $inning1->isBatting = 0;
            $inning0->isBatting = 1;
            $inning1->save();
            $inning0->save();
        }

        if ($match->status == 3) {
            $match_detail = MatchDetail::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->get();

            if($match->choose == 'Bat'){
                if($match->toss == $match_detail[0]->team_id){
                    $second_inning_team_id = $match_detail[1]->team_id;
                }
                else{
                    $second_inning_team_id = $match_detail[0]->team_id;
                }
            }
            else{
                if($match->toss == $match_detail[1]->team_id){
                    $second_inning_team_id = $match_detail[0]->team_id;
                }
                else{
                    $second_inning_team_id = $match_detail[1]->team_id;
                }
            }
            $inning = MatchDetail::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id',$second_inning_team_id)
                ->first();

            $inning->isBatting = 1;
            $inning->save();

            $match->won = 0;
            $match->description = "--";
            $match->save();

            ReverseCalculateNRRJob::dispatch($event->request->match_id);
        }
    }
}

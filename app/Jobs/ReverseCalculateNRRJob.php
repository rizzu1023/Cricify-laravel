<?php

namespace App\Jobs;

use App\Game;
use App\Models\GroupTeam;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReverseCalculateNRRJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $matchId;

    /**
     * Create a new job instance.
     *
     * @param $matchId
     */
    public function __construct($matchId)
    {
        $this->matchId = $matchId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $game = Game::with('MatchDetail')->where('match_id', $this->matchId)->first();
        $winningTeam = $game->MatchDetail->where('score')->sortByDesc('score')->first();
        $losingTeam = $game->MatchDetail->where('score')->sortBy('score')->first();

        $totalRunsScored = $winningTeam->score;
        $oversFaced = $winningTeam->over;
        $wicketsGone = $winningTeam->wicket == 10;
        $totalRunsConceded = $losingTeam->score;
        $totalOversBowled = $losingTeam->over;
        $wicketsTaken = $losingTeam->wicket == 10;
        $totalOvers = $game->overs;

        $nrr = calculateNRR($totalRunsScored, $oversFaced, $wicketsGone, $totalRunsConceded, $totalOversBowled, $wicketsTaken, $totalOvers);

        $winningGroupTeam = GroupTeam::where('team_id', $winningTeam->team_id)->where('tournament_id', $game->tournament_id)->first();
        $losingGroupTeam = GroupTeam::where('team_id', $losingTeam->team_id)->where('tournament_id', $game->tournament_id)->first();

        if($winningGroupTeam){
            $winningGroupTeam->points = $winningGroupTeam->points - 2;
            $winningGroupTeam->nrr = $winningGroupTeam->nrr - $nrr;
            $winningGroupTeam->won = $winningGroupTeam->won - 1 ;
            $winningGroupTeam->match = $winningGroupTeam->match - 1;
            $winningGroupTeam->update();
        }
        if($losingGroupTeam){
            $losingGroupTeam->nrr = $losingGroupTeam->nrr + $nrr;
            $losingGroupTeam->lost = $losingGroupTeam->lost - 1;
            $losingGroupTeam->match = $losingGroupTeam->match - 1;
            $losingGroupTeam->update();
        }

    }
}

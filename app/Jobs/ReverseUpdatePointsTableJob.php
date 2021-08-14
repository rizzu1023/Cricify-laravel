<?php

namespace App\Jobs;

use App\Models\GroupTeam;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReverseUpdatePointsTableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $match;

    /**
     * Create a new job instance.
     *
     * @param $match
     */
    public function __construct($match)
    {
        $this->match = $match;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $winningTeam = $this->match->MatchDetail->sortByDesc('score')->first();
        $losingTeam = $this->match->MatchDetail->sortBy('score')->first();

        $totalRunsScored = $winningTeam->score;
        $oversFaced = (float) $winningTeam->over.$winningTeam->overball;
        $wicketsGone = $winningTeam->wicket == 10;
        $totalRunsConceded = $losingTeam->score;
        $totalOversBowled = (float) $losingTeam->over.$losingTeam->overball;
        $wicketsTaken = $losingTeam->wicket == 10;
        $totalOvers = $this->match->overs;

        $nrr = calculateNRR($totalRunsScored, $oversFaced, $wicketsGone, $totalRunsConceded, $totalOversBowled, $wicketsTaken, $totalOvers);

        $winningGroupTeam = GroupTeam::where('team_id', $winningTeam->team_id)->where('tournament_id', $this->match->tournament_id)->first();
        $losingGroupTeam = GroupTeam::where('team_id', $losingTeam->team_id)->where('tournament_id', $this->match->tournament_id)->first();

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

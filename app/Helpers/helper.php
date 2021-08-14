<?php


function calculateNRR($totalRunsScored,$oversFaced,$wicketsGone,$totalRunsConceded,$totalOversBowled,$wicketsTaken,$totalOvers){
    if($wicketsGone){
        if($totalOvers == 0){
            $totalOvers = 1;
        }
        $runRateFor = $totalRunsScored / $totalOvers;
    }
    else{
        if($oversFaced == 0){
            $oversFaced = 1;
        }
        $runRateFor = $totalRunsScored / $oversFaced;
    }

    if($wicketsTaken){
        if($totalOvers == 0){
            $totalOvers = 1;
        }
        $runRateAgainst = $totalRunsConceded / $totalOvers;
    }
    else{
        if($totalOversBowled == 0){
            $totalOversBowled = 1;
        }
        $runRateAgainst = $totalRunsConceded / $totalOversBowled;
    }
    return number_format($runRateFor - $runRateAgainst,3);
}

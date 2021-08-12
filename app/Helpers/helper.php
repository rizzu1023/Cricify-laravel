<?php


function calculateNRR($totalRunsScored,$oversFaced,$wicketsGone,$totalRunsConceded,$totalOversBowled,$wicketsTaken,$totalOvers){
    if($wicketsGone){
        $runRateFor = $totalRunsScored / $totalOvers;
    }
    else{
        $runRateFor = $totalRunsScored / $oversFaced;
    }

    if($wicketsTaken){
        $runRateAgainst = $totalRunsConceded / $totalOvers;
    }
    else{
        $runRateAgainst = $totalRunsConceded / $totalOversBowled;
    }
    return number_format($runRateFor - $runRateAgainst,3);
}

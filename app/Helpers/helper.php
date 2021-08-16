<?php

function calculateBalls($max_over, $min_over, $max_overball, $min_overball)
{
    $min_over = $min_over . "." . $min_overball;
    $max_over = $max_over . "." . $max_overball;

    $max_int = (int)$max_over;
    $min_int = (int)$min_over;

    $max_frac = explode('.', number_format($max_over, 1))[1];
    $min_frac = explode('.', number_format($min_over, 1))[1];

    $min_balls = ($min_int * 6) + $min_frac;
    $max_balls = ($max_int * 6) + $max_frac;
    return $max_balls - $min_balls;
}

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



function calculateCRR($runs, $overs, $balls)
{
    $over = $overs + ($balls * 10) / 60;
    if ($overs == 0 && $balls == 0) {
        return $crr = 0;
    } elseif ($overs == 0) {
        $crr = ($runs / $balls) * 6;
        return (float)number_format((float)$crr, 2, '.', '');
    } else {
        $crr = $runs / $over;
        return (float)number_format((float)$crr, 2, '.', '');
    }
}

function calculateRRR($remaining_runs, $remaining_balls)
{
    $over = (int)($remaining_balls / 6);
    $balls = $remaining_balls % 6;
    $overs = $over + ($balls * 10) / 60;
    if ($overs == 0) {
        return $rrr = 0;
    }
    $rrr = ($remaining_runs / $overs);
    return (float)number_format((float)$rrr, 2, '.', '');
}

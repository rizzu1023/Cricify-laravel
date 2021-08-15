<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Teams;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $date = $this->dates;
        $d = new \DateTime($date);
        $dy = $d->format('D');
        $day = strtoupper($dy);

        $times = date('h:i A', strtotime($this->times));
        $dates = date('d M Y', strtotime($this->dates));


        // calculating required_balls from overs
        $current_over = 0;
        $current_overball = 0;
        $required_balls = 0;
        $required_runs = 0;
        $status = NULL;
        $description = NULL;
        $choose = NULL;
        $won = NULL;
        $toss = NULL;
        $batting_team = NULL;
        if ($this->Game) {

            $status = $this->Game['status'];
            $description = $this->Game['description'];
            $choose = $this->Game['choose'];
            $toss = $this->Game->Toss['team_code'];
            $batting_team_id= optional($this->Game->MatchDetail->where('isBatting',1)->first())->team_id;
            $batting_team = Teams::where('id',$batting_team_id)->first();

            if ($this->Game['status'] == 3) {
                if ($this->MatchDetail['0']->isBatting == '1') {
                    $current_over = $this->MatchDetail['0']->over;
                    $current_overball = $this->MatchDetail['0']->overball;
                } else {
                    $current_over = $this->MatchDetail['1']->over;
                    $current_overball = $this->MatchDetail['1']->overball;
                }
                $total_over = $this->Game['overs'];
                $total_overball = 0;

                $required_over = $total_over - $current_over;
                $required_overball = $total_overball - $current_overball;

                $required_balls = ($required_over * 6) + $required_overball;

                //calculating runs
                $fielding_team_score = 0;
                $batting_team_score = 0;
                if ($this->MatchDetail['0']->isBatting == '1') {
                    $batting_team_score = $this->MatchDetail['0']->score;
                    $fielding_team_score = $this->MatchDetail['1']->score;
                } else {
                    $batting_team_score = $this->MatchDetail['1']->score;
                    $fielding_team_score = $this->MatchDetail['0']->score;
                }

                $required_runs = ($fielding_team_score + 1) - $batting_team_score;
            }


        $team = Teams::where('id', $this->Game['won'])->first();
            if($team)
                $won = $team['team_code'];
            else{
                $won = '0';
            }
        }

        return [
            'status' => $status,
            'toss' => $toss,
            'choose' => $choose,
            'balls_required' => $required_balls,
            'runs_required' => $required_runs,
            'batting_team' => TeamResource::make($batting_team),
            'won' => $won,
            'description' => $description,
            'match_detail' => $this->MatchDetail,
            'id' => $this->id,
            'match_no' => $this->match_no,
            'team1_id' => TeamResource::make($this->Teams1),
            'team2_id' => TeamResource::make($this->Teams2),
            'times' => $times,
            'dates' => $dates,
            'day' => $day,
            'tournament_id' => $this->tournament_id,
        ];
    }
}

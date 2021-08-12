<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchPlayersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return float
     */

    public function calculate_economy($runs, $overs, $balls)
    {
        if($overs == 0 && $balls == 0){
            return 0;
        }
        else {
            $over = $overs + ($balls * 10) / 60;
            $crr = ($runs / $over);
            return (float)number_format((float)$crr, 2, '.', '');
        }
    }

    public function toArray($request)
    {
       $bw_economy = 0;
       if($this->bw_status != 'DNB'){
           $bw_economy = $this->calculate_economy($this->bw_runs,$this->bw_over,$this->bw_overball);
       }
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'player_id' => $this->player_id,
            'match_id' => $this->match_id,
            'team_id' => $this->team_id,
            'bt_status' => $this->bt_status,
            'bt_runs' => $this->bt_runs,
            'bt_balls' => $this->bt_balls,
            'bt_fours' => $this->bt_fours,
            'bt_sixes' => $this->bt_sixes,
            'bt_order' => $this->bt_order,
            'bw_status' => $this->bw_status,
            'bw_over' => $this->bw_over,
            'bw_overball' => $this->bw_overball,
            'bw_wickets' => $this->bw_wickets,
            'bw_runs' => $this->bw_runs,
            'bw_nb' => $this->bw_nb,
            'bw_maiden' => $this->bw_maiden,
            'bw_economy' => $bw_economy,
            'wicket_type' => $this->wicket_type,
            'wicket_primary' => $this->wicket_primary,
            'wicket_secondary' => $this->wicket_secondary,
            'tournament_id' => $this->tournament_id,
            'playerDetail' => new PlayersResource($this->Players),
            'wicketPrimary' => $this->wicketPrimary,
            'wicketSecondary' => $this->wicketSecondary,
        ];

    }
}

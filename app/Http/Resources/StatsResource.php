<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'playerDetail' => PlayersResource::make($this->Players),
            'matches' => $this->matches,
            'bt_runs' => (int)$this->bt_runs,
            'bt_balls' => $this->bt_balls,
            'bt_sr' => $this->bt_sr,
            'bt_innings' => (int)$this->bt_innings,
            'out_innings' => (int)$this->out_innings,

            'bt_sixes' => $this->bt_sixes,
            'bt_fours' => $this->bt_fours,
            'bt_hundreds' => $this->bt_hundreds,
            'bt_fifties' => $this->bt_fifties,
            'bt_average' => $this->bt_average,
            'average' => $this->average,
            'team_id' => $this->team_id,
            'bw_wickets' => $this->bw_wickets,
            'bw_runs' => $this->bw_runs,
            'bw_average' => $this->bw_average,
            'bw_over' => $this->bw_over,
            'bw_overball' => $this->bw_overball,
            'bw_sr' => $this->bw_sr,
            'bw_economy' => $this->bw_economy,
        ];
    }
}

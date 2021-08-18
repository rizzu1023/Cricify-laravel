<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerBowlingResource extends JsonResource
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
            'id' => $this->id,
            'player' => PlayersResource::make($this->Players),
            'bw_matches' => $this->bw_matches,
            'bw_innings' => $this->bw_innings,
            'bw_runs' => $this->bw_runs,
            'bw_overs' => $this->over . '.' .$this->overball,
            'bw_maidens' => $this->bw_maidens,
            'bw_wickets' => $this->bw_wickets,
            'bw_average' => $this->bw_average,
            'bw_economy' => $this->bw_economy,
            'bw_sr' => $this->bw_sr,
            'bw_bbi' => $this->bw_bbi,
            'bw_4w' => $this->bw_4w,
            'bw_5w' => $this->bw_5w,
        ];
    }
}

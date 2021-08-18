<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerBattingResource extends JsonResource
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
            'bt_matches' => $this->bt_matches,
            'bt_innings' => $this->bt_innings,
            'bt_runs' => $this->bt_runs,
            'bt_balls' => $this->bt_balls,
            'bt_highest' => $this->bt_highest,
            'bt_average' => $this->bt_average,
            'bt_sr' => $this->bt_sr,
            'bt_notout' => $this->bt_notout,
            'bt_fours' => $this->bt_fours,
            'bt_sixes' => $this->bt_sixes,
            'bt_ducks' => $this->bt_ducks,
            'bt_fifties' => $this->bt_fifties,
            'bt_hundreds' => $this->bt_hundreds,
        ];
    }
}

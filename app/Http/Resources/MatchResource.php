<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
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
            'match_id' => $this->match_id,
            'tournament' => $this->tournament,
            'toss' => $this->toss,
            'choose' => $this->choose,
            'won' => $this->won,
            'mom' => (String) $this->mom,
            'matchDetail' => $this->MatchDetail,
        ];
    }
}

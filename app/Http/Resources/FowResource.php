<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FowResource extends JsonResource
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
            'player' => $this->Batsman,
            'score' => $this->score,
            'wickets' => $this->wickets,
            'over' => $this->over,
            'overball' => $this->overball + 1,
        ];
    }
}

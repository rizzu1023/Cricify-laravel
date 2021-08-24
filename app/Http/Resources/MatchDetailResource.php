<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'match_id' => $this->match_id,
            'team_id' => $this->team_id,
            'score' => $this->score,
            'wicket' => $this->wicket,
            'over' => $this->over,
            'overball' => $this->overball,
            'isBatting' =>$this->isBatting,
            'no_ball' => $this->no_ball,
            'wide' => $this->wide,
            'byes' => $this->byes,
            'legbyes' => $this->legbyes,
            'tournament_id' => $this->tournament_id,
            'isOver' => $this->isOver,
            'team_detail' => TeamResource::make($this->Teams),
        ];
    }
}

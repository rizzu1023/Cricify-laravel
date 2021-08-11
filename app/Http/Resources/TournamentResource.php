<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TournamentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $start_date = Carbon::parse($this->start_date)->format('d M Y');
        $end_date = Carbon::parse($this->end_date)->format('d M Y');
        return [
            'id' => $this->id,
            'tournament_name' => $this->tournament_name,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayersResource extends JsonResource
{
    public function toArray($request)
    {
        if($this->dob){
            $today = Carbon::today();
            $dob = Carbon::parse($this->dob)->format('d-M-Y');
            $age = (string)Carbon::parse($this->dob)->diffInYears($today);
        }
        else{
            $dob = NULL;
            $age = NULL;
        }

        // TODO :: app_update
        return [
            'id' => 0,
            'player_profile' => $this->getFirstMedia('player-image') ? $this->getFirstMedia('player-image')->getUrl('player-profile') : NULL,
            'player_id' => (String) $this->player_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'role' => $this->Role->name,
            'dob' => $dob,
            'age' => $age,
            'batting_style' => $this->BattingStyle->name,
            'bowling_style' => $this->BowlingStyle->name,
//            'player_team' => $this->Teams,
        ];
    }
}

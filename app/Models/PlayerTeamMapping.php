<?php

namespace App\Models;

use App\Players;
use App\Teams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerTeamMapping extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function Player()
    {
        return $this->hasOne(Players::class,'player_id','player_id');
    }

    public function Team()
    {
        return $this->hasOne(Teams::class,'id','team_id');
    }
}

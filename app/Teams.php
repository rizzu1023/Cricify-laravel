<?php

namespace App;

use App\Models\PlayerTeamMapping;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teams extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

//    public function Players(){
//        return $this->hasMany('App\Players','team_id','id');
//    }

    public function Schedule1(){
        return $this->hasMany('App\Schedule','team1_id','id');
    }
    public function Schedule2(){
        return $this->hasMany('App\Schedule','team2_id','id');
    }

    public function Tournaments(){
        return $this->belongsTo('App\Tournament','tournament_id','id');
    }

//    public function Player(){
//        return $this->belongsToMany('App\Players','player_team','team_id','player_id')->withTimestamps();
//    }

    public function Players()
    {
        return $this->hasMany(PlayerTeamMapping::class,'team_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchPlayers extends Model
{
//    use SoftDeletes;

    protected $guarded = [];

    public function Players(){
        return $this->belongsTo('App\Players','player_id','player_id');
    }

    public function wicketPrimary(){
        return $this->belongsTo('App\Players','wicket_primary','player_id');
    }
    public function wicketSecondary(){
        return $this->belongsTo('App\Players','wicket_secondary','player_id');
    }

    public function Teams(){
        return $this->belongsTo('App\Teams','team_id','id');
    }

    public function Game(){
        return $this->belongsTo('App\Game','match_id','match_id');
    }

    public function MatchDetail(){
        return $this->hasMany('App\MatchDetail','match_id','match_id');
    }


}

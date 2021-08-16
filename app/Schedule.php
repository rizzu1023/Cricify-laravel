<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function Game(){
        return $this->hasOne('App\Game','match_id','id');
    }

    public function Tournament()
    {
        return $this->belongsTo(Tournament::class,'tournament_id','id');
    }

    public function  MatchDetail(){
        return $this->hasMany('App\MatchDetail','match_id','id');
    }

    public function Teams1(){
        return $this->belongsTo('App\Teams','team1_id','id');
    }
    public function Teams2(){
        return $this->belongsTo('App\Teams','team2_id','id');
    }

    public function addSchedule(){
        $data = request()->validate([
            'match_no' => 'required',
            'team1_id' => 'required',
            'team2_id' => 'required',
            'tournament' => 'required',
            'times' => 'required',
            'dates' => 'required',
        ]);

        return Schedule::create($data);
    }

    public function updateSchedule(){
        $data = request()->validate([
            'match_no' => 'required',
            'team1_id' => 'required',
            'team2_id' => 'required',
            'times' => 'required',
            'dates' => 'required',
            'tournament' => 'required',
            ]);

        return $this->update($data);
    }
}

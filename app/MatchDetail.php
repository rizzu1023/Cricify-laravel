<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchDetail extends Model
{
//    use SoftDeletes;

    protected $guarded = [];

    public function Teams()
    {
        return $this->belongsTo('App\Teams', 'team_id', 'id');
    }

    public function Game()
    {
        return $this->belongsTo('App\Game', 'match_id', 'match_id');
    }
}

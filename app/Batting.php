<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batting extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function Players(){
        return $this->hasOne('App\Players','player_id','player_id');
    }
}

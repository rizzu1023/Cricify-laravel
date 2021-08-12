<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupTeam extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function Teams()
    {
        return $this->hasOne('App\Teams','id','team_id');
    }

    public function Group()
    {
        return $this->belongsTo('App\Models\Group','group_id','id');
    }


}

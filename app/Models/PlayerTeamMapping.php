<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerTeamMapping extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}

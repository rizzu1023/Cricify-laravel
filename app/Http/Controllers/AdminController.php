<?php

namespace App\Http\Controllers;

use App\Players;
use App\Schedule;
use App\Teams;
use App\Tournament;


class AdminController extends Controller
{

    public function getDashboard(){
        $userId = auth()->user()->id;

        $teams = Teams::where('user_id',$userId)->get()->count();
        $players = Players::where('user_id',$userId)->get()->count();
        $tournaments = Tournament::where('user_id',$userId)->get()->count();
        $matches =  Schedule::whereHas('Tournament', function($query) use ($userId){
            return $query->where('user_id',$userId);
        })->count();
        return view('Admin/dashboard',compact('teams','players','tournaments','matches'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function appUsers()
    {
        $today = Carbon::today();

        $newUsers = AppUser::whereDate('created_at',$today)->count();
        $totalUsers = AppUser::count();
        $appUsed = AppUser::whereDate('created_at',$today)->orWhereDate('updated_at',$today)->count();

        $appUsers = AppUser::orderBy('hit_count','desc')->get();

        return view('Admin.AppUser.dashboard',compact('newUsers','appUsers','appUsed','totalUsers'));
    }
}

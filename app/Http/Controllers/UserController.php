<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(Request $request)
    {
        $users = User::where('is_super_admin',0)->get();
        return view('Admin.User.user-index',compact('users'));
    }
}

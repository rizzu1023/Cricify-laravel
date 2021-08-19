<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Teams;
use App\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->is_super_admin) {
            $advertise = Advertise::get();
            return view('Admin.Advertise.advertise-index', compact('advertise'));
        } else {
            return abort(403, 'Permission Denied.');
        }
    }

    public function create()
    {
        $tournaments = Tournament::get();
        $teams = Teams::get();
        return view('Admin.Advertise.advertise-create', compact('tournaments', 'teams'));
    }

    public function show(Request $request,Advertise $advertise)
    {
        return view('Admin.Advertise.advertise-show',compact('advertise'));
    }

    public function edit(Request $request)
    {
        return "fasdf";
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|max:1024',
            'name' => 'required|string',
            'height' => 'required|numeric',
            'page' => 'required|string',
//            'start_date' => 'date',
//            'end_date' => 'date',
        ]);

        $advertise = new Advertise();
        $advertise->name = $request->name;
        $advertise->height = $request->height;
        $advertise->page = $request->page;
        $advertise->start_date = $request->has('start_date') ? Carbon::parse($request->start_date)->toDateString() : NULL;
        $advertise->end_date = $request->has('end_date') ? Carbon::parse($request->end_date)->toDateString() : NULL;
        $advertise->team_id = $request->has('team_id') ? $request->team_id : NULL;
        $advertise->match_id = $request->has('match_id') ? $request->match_id : NULL;
        $advertise->tournament_id = $request->has('tournament_id') ? $request->tournament_id : NULL;
        $advertise->save();

        $advertise->addMediaFromRequest('image')->toMediaCollection('advertise-image');

        return redirect()->route('advertise.index')->with(['message' => "Advertise Successfully Added"]);
    }

    public function update(Request $request)
    {

    }

    public function destroy(Advertise $advertise)
    {
        $advertise->delete();
        return back()->with(['message' => 'Advertise Successfully Deleted!']);
    }
}

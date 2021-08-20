<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // $tournament = Tournament::all();
        // $teams = Teams::first();
        // $teams->Tournaments()->syncWithoutDetaching($tournament);


        // $teams = Teams::first();
        // $teams->Tournaments()->sync([
        //     23 => [
        //         'position' => 'Champions',
        //     ]
        // ]);


        // $teams = Teams::first();
        // dd($teams->Tournaments->first()->pivot->position);

        // $team_id = 1;
        // $tournaments = Tournament::whereHas('teams',function($query) use($team_id){
        //     $query->where('team_id',$team_id);
        // })->get();
        // return $tournaments;



        $user = auth()->user();
        $Tournament = Tournament::where('user_id',$user->id)->get();
        if($user->is_super_admin){
            $Tournament = Tournament::all();
        }

        return view('Admin/Tournament/index',compact('Tournament'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
       return view('Admin/Tournament/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Tournament::create([
            'tournament_name' => request('tournament_name'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'user_id' => auth()->user()->id,
        ]);
        return redirect::route('Tournament.index')->with('message',"Added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Tournament $Tournament)
    {
        $id = auth()->user()->id;
        $Team = Teams::where('user_id',$id)->get();
        $id = $Tournament->id;
        $tournament_team = Teams::whereHas('tournaments',function($query) use($id){
            $query->where('tournament_id',$id);
        })->get();
        // return $tournament_team;
        return view('Admin/Tournament/show',compact('Tournament','Team','tournament_team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Tournament $Tournament)
    {
        return view('Admin/Tournament/edit',compact('Tournament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $Tournament = Tournament::find($id);
        $Tournament->update([
            'tournament_name' => request('tournament_name'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
        ]);

        return redirect::route('Tournament.index')->with('message','Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tournament $Tournament)
    {
        $Tournament->delete();
        return redirect::route('Tournament.index')->with('message','Deleted');
    }

    public function Tournament_add_Team(Request $request)
    {
        $team = Teams::find(request('team_id'));
        $tournament = Tournament::find(request('tournament_id'));
        $team->Tournaments()->syncWithoutDetaching($tournament);

        return back()->with('message','Team Added to Tournament');
    }

    public function Tournament_destroy_Team(Request $request){
        $team =  Teams::where('id',$request->team_id)->first();
        $tournament = Tournament::where('id',$request->tournament_id)->first();

        $tournament->Teams()->detach($team);

        return back()->with('message','Team has been delete from Tournament');
    }
}

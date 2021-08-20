<?php

namespace App\Http\Controllers;

use App\Players;
use App\Schedule;
use App\Teams;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class TournamentTeamController extends Controller
{

    public function index(Tournament $tournament)
    {
        $user  = auth()->user();
        $teams = Teams::where('tournament_id',$tournament->id)->where('user_id',$user->id)->get();
        if($user->is_super_admin){
            $teams = Teams::where('tournament_id',$tournament->id)->get();

        }
        return view('Admin.Tournament.tournament-team-index',compact('teams','tournament'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Tournament $tournament)
    {
        return view('Admin.Tournament.tournament-team-create',compact('tournament'));
    }


    public function store(Request $request,Tournament $tournament)
    {
        $team = Teams::create([
            'team_code' => $request['team_code'],
            'team_name' => $request['team_name'],
            'tournament_id' => $tournament->id,
            'user_id' => auth()->user()->id,
        ]);

//        $tnt = Tournament::find($tournament);
//        $team->Tournaments()->syncWithoutDetaching($tnt);

        return back()->with('message','Team Successfully Added');
//        return response()->json(['message'=> 'Team has been successfully added']);
//        return redirect::route('Team.index')->with('message','Team has been successfully added');
    }


    public function show(Tournament $tournament,Teams $team)
    {
        return view('Admin.Tournament.tournament-team-show',compact('team','tournament'));
    }

    public function edit(Tournament $tournament, Teams $team)
    {
        return view('Admin.Tournament.tournament-team-edit',compact('team','tournament'));
    }

    public function update(Request $request, Tournament $tournament, Teams $team)
    {
        $team->update([
            'team_code' => $request['team_code'],
            'team_name' => $request['team_name'],
            'user_id' => auth()->user()->id,
        ]);
        return redirect::route('tournaments.teams.index',$tournament->id)->with('message','Team has been successfully updated');
    }

    public function destroy(Tournament $tournament,Teams $team)
    {
        $team_id = $team->id;
        $schedule = Schedule::where('team1_id',$team->id)->orWhere('team2_id',$team->id)->first();
        $players = Players::whereHas('teams',function($query) use($team_id){
            $query->where('team_id',$team_id);
        })->get();
        if(count($players) > 0) return back()->with('message','First Remove all of this team players');
        if($schedule){
            return back()->with('message','First Delete Schedule of This Team');
        }
        else{
            $team->delete();
            return back()->with('message','Team has been successfully deleted');
        }


    }

    public function teamFilter(Request $request){
        $id = request('tournament_id');
        // return $id;
        $tournament = Tournament::all();
        $team = Teams::whereHas('tournaments',function($query) use($id){
            $query->where('tournament_id',$id);
        })->get();
        return view('Admin/Team/index',compact('tournament','team'));
    }
}

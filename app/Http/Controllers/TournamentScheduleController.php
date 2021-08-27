<?php

namespace App\Http\Controllers;

use App\MatchDetail;
use App\Schedule;
use App\Teams;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TournamentScheduleController extends Controller
{

    public function index(Tournament $tournament)
    {
        $schedule = Schedule::where('tournament_id',$tournament->id)->orderBy('dates','desc')->orderBy('times','desc')->get();
        return view('Admin.Schedule.index',compact('schedule','tournament'));
    }


    public function create(Tournament $tournament)
    {
        $teams = Teams::where('tournament_id',$tournament->id)->get();
        return view('Admin.Schedule.create',compact('teams','tournament'));
    }


    public function store(Request $request, $tournament)
    {
        $data = request()->validate([
            'match_no' => 'required',
            'team1_id' => 'required',
            'team2_id' => 'required',
            'times' => 'required',
            'dates' => 'required',
        ]);

        Schedule::create([
            'match_no' => $request->match_no,
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'times' => $request->times,
            'dates' => $request->dates,
            'tournament_id' => $tournament,
        ]);
        return redirect::route('tournaments.schedules.index',$tournament)->with('message','Succesfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Tournament $tournament,Schedule $schedule)
    {
        $tournament_id = $tournament->id;
        $teams = Teams::whereHas('Tournaments',function($query) use($tournament_id){
            $query->where('tournament_id',$tournament_id)->where('user_id',auth()->user()->id);
        })->get();
        return view('Admin.Schedule.edit',compact('schedule','teams','tournament'));
    }


    public function update(Request $request, Tournament $tournament,Schedule $schedule)
    {
        $valid_data = $request->validate([
            'match_no' => 'required',
            'team1_id' => 'required',
            'team2_id' => 'required',
            'times' => 'required',
            'dates' => 'required',
            'tournament_id' => 'required',
        ]);

        $schedule->update($valid_data);
        return redirect::route('tournaments.schedules.index',$tournament->id)->with('message','Succesfully Added');
    }

    public function destroy(Tournament $tournament,Schedule $schedule)
    {
        $schedule->delete();
        return back()->with('message','Successfully Deleted');
    }

    public function results(Tournament $tournament)
    {
        //TODO :: need to change logic
        $result = MatchDetail::where('tournament_id',$tournament->id)->orderBy('match_id','desc')->get();
        return view('Admin/Result/index',compact('result'));
    }
}

<?php

namespace App\Http\Controllers;


use App\Batting;
use App\Bowling;
use App\Imports\PlayerImport;
use App\Models\MasterBattingStyle;
use App\Models\MasterBowlingStyle;
use App\Models\MasterRole;
use App\Players;
use App\Teams;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class PlayersController extends Controller
{
    public function index()
    {
       $players = Players::with('Role','BattingStyle','BowlingStyle')->where('user_id' , auth()->user()->id)->get();
       return view('Admin.Player.playerIndex',compact('players'));
    }

    public function create()
    {
        $masterRoles = MasterRole::where('status',1)->get();
        $masterBattingStyles = MasterBattingStyle::where('status',1)->get();
        $masterBowlingStyles = MasterBowlingStyle::where('status',1)->get();
        return view('Admin.Player.playerCreate',compact('masterRoles','masterBattingStyles','masterBowlingStyles'));
    }
    public function show($id)
    {

        $player = Players::find($id);
        $bt = Batting::where('player_id',$player->player_id)->first();
        $bw = Bowling::where('player_id',$player->player_id)->first();

        $player_teams = Teams::whereHas('players',function($query) use($id){
            $query->where('player_team.player_id',$id);
        })->get();

        $teams = Teams::all();

        return view('Admin.Player.playerShow',compact('player','bt','bw','player_teams','teams'));
    }

    public function store(Request $request)
    {

        $data = $this->validate($request,[
            'player_id' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'role_id' => 'required|string',
            'batting_style_id' => 'required',
            'bowling_style_id' => '',
        ]);


        Players::create([
            'player_id' => $request['player_id'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'role_id' => $request['role_id'],
            'batting_style_id' => $request['batting_style_id'],
            'bowling_style_id' => $request['bowling_style_id'],
            'dob' => $request['dob'],
            'user_id' => auth()->user()->id,
        ]);

        Batting::create(request(['player_id']));
        Bowling::create(request(['player_id']));

        return back()->with('message','Player Added');

    }

    public function edit($id)
    {
        $player = Players::find($id);
        $roles = MasterRole::where('status',1)->get();
        $battingStyles = MasterBattingStyle::where('status',1)->get();
        $bowlingStyles = MasterBowlingStyle::where('status',1)->get();
        return view('Admin.Player.playerEdit',compact('player','roles','battingStyles','bowlingStyles'));

    }

    public function update(Request $request,$id)
    {
        $player = Players::find($id);

        $data= request()->validate([
            'player_id' => 'required|min:2',
            'first_name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required',
            'batting_style_id' => 'required',
            'bowling_style_id' => '',
            'dob' => '',
        ]);

        $request->validate([
            'player_image' => 'sometimes|required|mimes:png,jpeg,jpg'
        ]);

        $player->update($data);
        if($request->hasFile('player_image')){
            $player->addMediaFromRequest('player_image')->toMediaCollection('player-image');
        }
        return redirect('/admin/player')->with('message','Player Updated');
    }

    public function destroy($id)
    {
        $player = Players::find($id);
        $player->delete();

        $pid = $player->player_id;

        $bt_player = Batting::where('player_id', $pid)->first();
        if($bt_player) $bt_player->delete();

        $bw_player = Bowling::where('player_id', $pid)->first();
        if($bw_player) $bw_player->delete();

        $teams = Teams::all();
        $player->Teams()->detach($teams);

        return back()->with('message','Player Deleted');
    }


    public function add_in_team(Request $request)
    {
        $player = Players::find($request->player_id);
        $team = Teams::find($request->team_id);
        $player->Teams()->syncWithoutDetaching($team);
        return back()->with('message','Successfully added in Team');
    }

    public function remove_from_team(Request $request)
    {
        $player = Players::find($request->player_id);
        $team = Teams::find($request->team_id);
        $player->Teams()->detach($team);
        return back()->with('message','Successfully removed from Team');
    }

    public function storeExcelPlayer(Request $request)
    {
        $request->validate([
            'player_sheet' => 'required|mimes:xls,xlsx',
            'team_id' => 'sometimes|required|exists:teams,id',
        ]);


        $user = auth()->user();
        if($request->hasFile('player_sheet')){
            $team = NULL;
            if($request->has('team_id')){
                $team = Teams::find($request->team_id);
            }
            Excel::import(new PlayerImport($user,$team), $request->file('player_sheet'));

            return back()->with([ 'status' => true, 'message' => 'File Successfully Uploaded']);
        }

        return back()->with(['status' => false, 'message' => 'Something Went Wrong..!']);

    }

}



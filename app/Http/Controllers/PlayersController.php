<?php

namespace App\Http\Controllers;


use App\Batting;
use App\Bowling;
use App\Imports\PlayerImport;
use App\Models\MasterBattingStyle;
use App\Models\MasterBowlingStyle;
use App\Models\MasterRole;
use App\Models\PlayerTeamMapping;
use App\Players;
use App\Teams;
use App\MatchPlayers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class PlayersController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if($user->is_super_admin){
            $players = Players::with('media','Role', 'BattingStyle', 'BowlingStyle')->get();
        }
        else{
            $players = Players::with('media','Role', 'BattingStyle', 'BowlingStyle')->where('user_id', $user->id)->get();
        }
        return view('Admin.Player.playerIndex', compact('players'));
    }

    public function create()
    {
        $masterRoles = MasterRole::where('status', 1)->get();
        $masterBattingStyles = MasterBattingStyle::where('status', 1)->get();
        $masterBowlingStyles = MasterBowlingStyle::where('status', 1)->get();
        return view('Admin.Player.playerCreate', compact('masterRoles', 'masterBattingStyles', 'masterBowlingStyles'));
    }

    public function show($id)
    {

        $player = Players::where('player_id', $id)->first();

        $bt = Batting::where('player_id', $player->player_id)->first();
        $bw = Bowling::where('player_id', $player->player_id)->first();

        $player_id = $player->player_id;
        $player_teams = Teams::whereHas('Players', function ($query) use ($player_id) {
            $query->where('player_id', $player_id);
        })->get();

        $teams = Teams::all();

        return view('Admin.Player.playerShow', compact('player', 'bt', 'bw', 'player_teams', 'teams'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'mobile_number' => 'required|unique:players,mobile_number',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'role_id' => 'required|string',
            'batting_style_id' => 'required',
            'bowling_style_id' => '',
        ]);


        $player = new Players();
        $player->mobile_number = $request->mobile_number;
        $player->first_name = $request->first_name;
        $player->last_name = $request->last_name;
        $player->role_id = $request->role_id;
        $player->batting_style_id = $request->batting_style_id;
        $player->bowling_style_id = $request->bowling_style_id;
        $player->dob = $request->has('dob') ? Carbon::parse($request->dob)->toDateString() : NULL;
        $player->user_id = auth()->user()->id;
        $player->save();

        Batting::create([
            'player_id' => $player->player_id
        ]);
        Bowling::create([
            'player_id' => $player->player_id
        ]);

        return back()->with('message', 'Player Added');

    }

    public function edit($id)
    {
        $player = Players::where('player_id', $id)->first();
        $roles = MasterRole::where('status', 1)->get();
        $battingStyles = MasterBattingStyle::where('status', 1)->get();
        $bowlingStyles = MasterBowlingStyle::where('status', 1)->get();
        return view('Admin.Player.playerEdit', compact('player', 'roles', 'battingStyles', 'bowlingStyles'));

    }

    public function update(Request $request, $id)
    {
        $player = Players::where('player_id',$id)->first();

        $data = request()->validate([
            'mobile_number' => 'required',
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
        if ($request->hasFile('player_image')) {
            $player->addMediaFromRequest('player_image')->toMediaCollection('player-image');
        }
        return redirect('/admin/player')->with('message', 'Player Updated');
    }

    public function destroy($id)
    {
        $player = Players::where('player_id',$id)->first();

        $matchPlayer = MatchPlayers::where('player_id', $player->player_id)->first();
        if ($matchPlayer) {
            return back()->with(['error' => 'You can not delete this player because he played some matches.']);
        }
        if ($player->Teams->isNotEmpty()) {
            return back()->with(['error' => 'Remove this player from squads']);
        }

        $pid = $player->player_id;

        $bt_player = Batting::where('player_id', $pid)->first();
        if ($bt_player) $bt_player->delete();

        $bw_player = Bowling::where('player_id', $pid)->first();
        if ($bw_player) $bw_player->delete();

        $player->delete();


        return back()->with('message', 'Player Deleted');
    }


    public function add_in_team(Request $request)
    {
        $player = Players::where('player_id',$request->player_id)->first();
        $team = Teams::find($request->team_id);
        PlayerTeamMapping::where('team_id',$team->id)->where('player_id',$player->player_id)->firstOrcreate([
            'team_id' => $team->id,
            'player_id' => $player->player_id
        ]);
        return back()->with('message', $player->first_name . ' ' . $player->last_name . 'Successfully added in ' . $team->team_name);
    }

    public function remove_from_team(Request $request)
    {
        $player = Players::where('player_id',$request->player_id)->first();
        $team = Teams::find($request->team_id);
        $mapping = PlayerTeamMapping::where('team_id',$team->id)->where('player_id',$player->player_id)->first();
        $mapping ? $mapping->delete() : NULL;
        return back()->with('message', 'Successfully removed from Team');
    }

    public function storeExcelPlayer(Request $request)
    {
        $request->validate([
            'player_sheet' => 'required|mimes:xls,xlsx',
            'team_id' => 'sometimes|required|exists:teams,id',
        ]);


        $user = auth()->user();
        if ($request->hasFile('player_sheet')) {
            $team = NULL;
            if ($request->has('team_id')) {
                $team = Teams::find($request->team_id);
            }
            Excel::import(new PlayerImport($user, $team), $request->file('player_sheet'));

            return back()->with(['status' => true, 'message' => 'File Successfully Uploaded']);
        }

        return back()->with(['status' => false, 'message' => 'Something Went Wrong..!']);

    }

}



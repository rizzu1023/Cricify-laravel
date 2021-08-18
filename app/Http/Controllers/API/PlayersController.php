<?php

namespace App\Http\Controllers\API;

use App\Batting;
use App\Bowling;
use App\Http\Resources\PlayerBattingResource;
use App\Http\Resources\PlayerBowlingResource;
use App\Http\Resources\PlayersResource;
use App\Players;
use App\Teams;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Teams $team)
    {
        $team_id = $team->id;
//        $player = Players::whereHas('teams',function($query) use($team_id){
//            $query->where('team_id',$team_id);
//        })->orderByRaw("FIELD(role, 'Batsman','WK-Batsman','Allrounder','Bowler')")->get();

        $player = Players::with('media','Role','BattingStyle','BowlingStyle')->whereHas('teams',function($query) use($team_id){
            $query->where('team_id',$team_id);
        })->get();

        return PlayersResource::collection($player);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'player_id' => 'required|unique:players',
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'batting_style' => 'required',
            'bowling_style' => '',
            'team_id' => 'required',
        ]);

        return Players::create([
            'player_id' => $request['player_id'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'role' => $request['role'],
            'batting_style' => $request['batting_style'],
            'bowling_style' => $request['bowling_style'],
            'team_id' => $request['team_id'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return PlayersResource
     */
    public function show(Players $player)
    {
       return new PlayersResource($player);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $player = Players::findOrFail($id);

        $this->validate($request,[
            'player_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'batting_style' => 'required',
            'bowling_style' => '',
            'team_id' => 'required',
        ]);

        $player->update($request->all());

        return ['message' , 'Player updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $player = Players::findOrFail($id);
        $matchPlayer = MatchPlayers::where('player_id',$player->player_id)->first();
        if($matchPlayer){
            return back()->with(['error' => 'You can not delete this player because he played some matches.']);
        }
        if($player->Teams->isNotEmpty()){
            return back()->with(['error' => 'Remove this player from squads']);
        }
//        $player->delete();
        return back()->with(['message' => 'Player Deleted']);
    }

    public function playerBatting($playerId)
    {
        $player = Batting::where('player_id',$playerId)->first();
        if($player){
            return PlayerBattingResource::make($player);
        }
        return response()->json(['status' => false,'message' => 'Player Not Found'],404);
    }

    public function playerBowling($playerId)
    {
        $player = Bowling::where('player_id',$playerId)->first();
        if($player){
            return PlayerBowlingResource::make($player);
        }
        else{
            return response()->json(['status' => false,'message' => 'Player Not Found'],404);
        }

    }
}

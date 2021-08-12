<?php

namespace App\Http\Controllers\API;

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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = Players::findOrFail($id);
        $player->delete();
        return ['message' => 'Player Deleted'];
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Game;
use App\MatchDetail;
use App\MatchPlayers;
use App\MatchTrack;
use App\Players;
use App\Tournament;
use Illuminate\Http\Request;

class ResultController extends Controller
{

    public function BrowseResult()
    {
        $tournaments = Tournament::where("user_id", auth()->user()->id)->first();
        $result = MatchDetail::orderBy('match_id', 'asc')->get();
        return view('Admin/Result/index', compact('result'));
    }


    public function result_show($tournament_id, $match_id)
    {
        $match = Game::where('tournament_id', $tournament_id)->where('match_id', $match_id)->first();
        $match_detail = MatchDetail::where('tournament_id', $tournament_id)->where('match_id', $match_id)->get();
        $single_result = MatchPlayers::where('match_id', $match_id)->get();
        $team1_id = $match_detail['0']['team_id'];
        $team2_id = $match_detail['1']['team_id'];
        $subs1_players = Players::whereHas('teams', function ($query) use ($team1_id) {
            $query->where('team_id', $team1_id);
        })->get();
        $subs2_players = Players::whereHas('teams', function ($query) use ($team2_id) {
            $query->where('team_id', $team2_id);
        })->get();
        return view('Admin/Result/show', compact('single_result', 'match', 'match_detail', 'subs1_players', 'subs2_players'));
    }


    public function result_destroy(Request $request)
    {
        $result = MatchDetail::where('tournament_id', $request->tournament)->orderBy('match_id', 'asc')->get();
        $match_id = $request->match_id;
        $match = Game::where('match_id', $match_id)->where('tournament_id', $request->tournament)->first();
        $match->delete();

        $match_detail = MatchDetail::where('match_id', $match_id)->where('tournament_id', $request->tournament)->get();
        for ($i = 0; $i < count($match_detail); $i++) {
            $m = MatchDetail::where('match_id', $match_id)->first();
            $m->delete();
        }

        $gamexi = MatchPlayers::where('match_id', $match_id)->get();
        for ($j = 0; $j < count($gamexi); $j++) {
            $g = MatchPlayers::where('match_id', $match_id)->first();
            $g->delete();
        }

        $matchTrack = MatchTrack::where('match_id', $match_id)->where('tournament_id', $request->tournament)->get();
        for ($j = 0; $j < count($matchTrack); $j++) {
            $g = MatchTrack::where('match_id', $match_id)->first();
            $g->delete();
        }
        return redirect('/admin/tournaments/' . $request->tournament . '/results')->with('message', 'Successfully Deleted');
//        return redirect::route('BrowseResult',compact('result'));
    }

    public function update_overs(Request $request)
    {
        $result = MatchDetail::orderBy('match_id', 'asc')->get();
        $match_detail = MatchDetail::where('match_id', $request->match_id)->get();
        foreach ($match_detail as $m) {
            if ($m->over > $request->overs) {
                return back()->with('error', "you can't set overs more than played");
            }
        }

        $match = Game::where('match_id', $request->match_id)->first();
        $match->overs = $request->overs;
        $match->save();

        return back()->with('message', 'Success');

    }

    public function update_toss(Request $request)
    {
        $match = Game::where('match_id', $request->match_id)->first();
        $match->toss = $request->toss;
        $match->save();

        return back()->with('message', 'Success');
    }

    public function update_choose(Request $request)
    {
        $match = Game::where('match_id', $request->match_id)->first();
        $match->choose = $request->choose;
        $match->save();

        return back()->with('message', 'Success');
    }

    public function update_player(Request $request)
    {
        $player = MatchPlayers::where('player_id', $request->sub_player)
            ->where('team_id', $request->team_id)
            ->where('match_id', $request->match_id)
            ->where('tournament_id', $request->tournament_id)
            ->first();
        if ($player)
            return back()->with('error', "this player already playing in this match");

        $game = Game::where('mom', $request->player_id)
            ->where('match_id', $request->match_id)
            ->where('tournament_id', $request->tournament_id)
            ->update(['mom' => $request->sub_player]);

        $player = MatchPlayers::where('player_id', $request->player_id)
            ->where('team_id', $request->team_id)
            ->where('match_id', $request->match_id)
            ->where('tournament_id', $request->tournament_id)
            ->update(['player_id' => $request->sub_player]);

        $wicket_primary = MatchPlayers::where('wicket_primary', $request->player_id)
            ->where('match_id', $request->match_id)
            ->where('tournament_id', $request->tournament_id)
            ->get();

        foreach ($wicket_primary as $mt) {
            $mt->wicket_primary = $request->sub_player;
            $mt->save();
        }

        $wicket_secondary = MatchPlayers::where('wicket_secondary', $request->player_id)
            ->where('match_id', $request->match_id)
            ->where('tournament_id', $request->tournament_id)
            ->get();

        foreach ($wicket_secondary as $mt) {
            $mt->wicket_secondary = $request->sub_player;
            $mt->save();
        }

        $match_track = MatchTrack::where('player_id', $request->player_id)
            ->where('team_id', $request->team_id)
            ->where('match_id', $request->match_id)
            ->where('tournament_id', $request->tournament_id)
            ->get();

        foreach ($match_track as $mt) {
            $mt->player_id = $request->sub_player;
            $mt->save();
        }

        $match_track2 = MatchTrack::where('attacker_id', $request->player_id)
            ->where('match_id', $request->match_id)
            ->where('tournament_id', $request->tournament_id)
            ->get();

        foreach ($match_track2 as $mt) {
            $mt->attacker_id = $request->sub_player;
            $mt->save();
        }

        return back()->with('message', 'Success');
    }

    public function update_score(Request $request)
    {
        $score = MatchDetail::where('team_id', $request->team_id)
            ->where('match_id', $request->match_id)
            ->where('tournament_id', $request->tournament_id)
            ->first();

        $score->score = $request->score;
        $score->wicket = $request->wicket;
        $score->over = $request->over;
        $score->overball = $request->overball;
        if ($score->save()) {
            return back()->with('message', 'Success');
        } else {
            return back()->with('error', 'failed');
        }


    }
}

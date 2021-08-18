<?php

namespace App\Http\Controllers;

use App\Events\byesFourRunEvent;
use App\Events\byesOneRunEvent;
use App\Events\byesThreeRunEvent;
use App\Events\byesTwoRunEvent;
use App\Events\DeclareBatsmanEvent;
use App\Events\dotBallEvent;
use App\Events\endInningEvent;
use App\Events\fiveRunEvent;
use App\Events\fourRunEvent;
use App\Events\legByesFourRunEvent;
use App\Events\legByesOneRunEvent;
use App\Events\legByesThreeRunEvent;
use App\Events\legByesTwoRunEvent;
use App\Events\newOverEvent;
use App\Events\noballFiveRunEvent;
use App\Events\noballFourRunEvent;
use App\Events\noballOneRunEvent;
use App\Events\noballSixRunEvent;
use App\Events\noballThreeRunEvent;
use App\Events\noballTwoRunEvent;
use App\Events\noballZeroRunEvent;
use App\Events\oneRunEvent;
use App\Events\resetInningEvent;
use App\Events\RetiredHurtBatsmanEvent;
use App\Events\reverseByesFourRunEvent;
use App\Events\reverseByesOneRunEvent;
use App\Events\reverseByesThreeRunEvent;
use App\Events\reverseByesTwoRunEvent;
use App\Events\reverseDotBallEvent;
use App\Events\reverseEndInningEvent;
use App\Events\reverseFiveRunEvent;
use App\Events\reverseFourRunEvent;
use App\Events\reverseLegByesFourRunEvent;
use App\Events\reverseLegByesOneRunEvent;
use App\Events\reverseLegByesThreeRunEvent;
use App\Events\reverseLegByesTwoRunEvent;
use App\Events\reverseNoballFiveRunEvent;
use App\Events\reverseNoballFourRunEvent;
use App\Events\reverseNoballOneRunEvent;
use App\Events\reverseNoballSixRunEvent;
use App\Events\reverseNoballThreeRunEvent;
use App\Events\reverseNoballTwoRunEvent;
use App\Events\reverseNoballZeroRunEvent;
use App\Events\reverseOneRunEvent;
use App\Events\reverseSixRunEvent;
use App\Events\reverseThreeRunEvent;
use App\Events\reverseTwoRunEvent;
use App\Events\reverseWicketEvent;
use App\Events\reverseWideFourRunEvent;
use App\Events\reverseWideOneRunEvent;
use App\Events\reverseWideThreeRunEvent;
use App\Events\reverseWideTwoRunEvent;
use App\Events\reverseWideZeroRunEvent;
use App\Events\sixRunEvent;
use App\Events\startInningEvent;
use App\Events\strikeRotateEvent;
use App\Events\threeRunEvent;
use App\Events\twoRunEvent;
use App\Events\wicketEvent;
use App\Events\wideFourRunEvent;
use App\Events\wideOneRunEvent;
use App\Events\wideThreeRunEvent;
use App\Events\wideTwoRunEvent;
use App\Events\wideZeroRunEvent;
use App\Game;
use App\Http\Resources\MatchResource;
use App\MatchDetail;
use App\MatchPlayers;
use App\MatchTrack;
use App\Players;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class LiveScoreController extends Controller
{
    public function LiveScoreIndex()
    {
        $schedule = Schedule::WhereIn('tournament_id', function ($query) {
            $query->select('id')
                ->from('tournaments')
                ->where('user_id', auth()->user()->id);
        })->get();
        $start = Game::all();
        return view('Admin/LiveScore/index', compact('schedule', 'start'));
    }

    public function StartScore($id)
    {
        $schedule = Schedule::where('id', $id)->first();
        $team1_id = $schedule->team1_id;
        $players1 = Players::whereHas('teams', function ($query) use ($team1_id) {
            $query->where('team_id', $team1_id);
        })->get();
        $team2_id = $schedule->team2_id;
        $players2 = Players::whereHas('teams', function ($query) use ($team2_id) {
            $query->where('team_id', $team2_id);
        })->get();

        $player_max_limit = (int)Config::get('app.player_max_limit');

        return view('Admin/LiveScore/StartScore', compact('schedule', 'players1', 'players2','player_max_limit'));
    }

    public function ScoreDetails(Request $request)
    {

        $player_min_limit = (int)Config::get('app.player_min_limit');
        $player_max_limit = (int)Config::get('app.player_max_limit');


        $request->validate([
            'id' => 'required',
            'overs' => 'required|integer',
            'tournament_id' => 'required',
            'toss' => 'required|integer',
            'choose' => 'required|string',
            'team1' => 'required|array',
            'team2' => 'required|array',
        ]);

        if(sizeOf($request->team1) < $player_min_limit || sizeOf($request->team1) > $player_max_limit){
            return response()->json(['status' => false, 'message' => 'Please select at least ' . $player_min_limit . ' players in Team 1.']);
        }
        if(sizeOf($request->team2) < $player_min_limit || sizeOf($request->team2) > $player_max_limit){
            return response()->json(['status' => false, 'message' => 'Please select at least ' . $player_min_limit . ' players in Team 2.']);
        }
        if($request->overs < 1){
            return response()->json(['status' => false, 'message' => 'Overs should be more than 0']);
        }

        $game = Game::where('match_id',$request->id)->first();
        if($game){
            return response()->json(['status' => false, 'message' => 'Match Details Already Submitted']);
        }


        DB::transaction(function () use ($request) {

            $game = new Game();

            $game->match_id = $request->id;
            $game->overs = $request->overs;
            $game->tournament_id = $request->tournament_id;
            $game->toss = $request->toss;
            $game->choose = $request->choose;
            $game->umpire_1 = $request->has('umpire_1') ? $request->umpire_1 : NULL;
            $game->umpire_2 = $request->has('umpire_2') ? $request->umpire_2 : NULL;
            $game->save();

            $matchDetail1 = new MatchDetail();
            $matchDetail1->match_id = $game->match_id;
            $matchDetail1->team_id = $request->team1_id;
            $matchDetail1->tournament_id = $request->tournament_id;

            $matchDetail2 = new MatchDetail();
            $matchDetail2->match_id = $game->match_id;
            $matchDetail2->team_id = $request->team2_id;
            $matchDetail2->tournament_id = $request->tournament_id;

            if ($request->choose == 'Bat')
                if ($request->toss == $request->team1_id) {
                    $matchDetail1->isBatting = 1;
                    $matchDetail2->isBatting = 0;
                } else {
                    $matchDetail1->isBatting = 0;
                    $matchDetail2->isBatting = 1;
                }
            else {
                if ($request->toss == $request->team1_id) {
                    $matchDetail1->isBatting = 0;
                    $matchDetail2->isBatting = 1;
                } else {
                    $matchDetail1->isBatting = 1;
                    $matchDetail2->isBatting = 0;
                }
            }

            $matchDetail1->save();
            $matchDetail2->save();

            foreach ($request->team1 as $t1) {
                MatchPlayers::create([
                    'match_id' => $game->match_id,
                    'player_id' => $t1,
                    'team_id' => $request->team1_id,
                    'tournament_id' => $request->tournament_id,
                ]);
            }
            foreach ($request->team2 as $t2) {
                MatchPlayers::create([
                    'match_id' => $game->match_id,
                    'player_id' => $t2,
                    'team_id' => $request->team2_id,
                    'tournament_id' => $request->tournament_id,
                ]);
            }
        });
        return response()->json(['status' => true, 'tournament_id' => $request->tournament_id, 'match_id' => $request->id]);
    }


    public function LiveUpdateShow($id, $tournament)
    {
        $game = Game::with('MatchDetail','MatchPlayers.Players')->where('match_id', $id)->where('tournament_id', $tournament)->first();
        $match_detail = $game->MatchDetail;

        $batting_team = $match_detail->where('isBatting',1)->first();
        $bowling_team = $match_detail->where('isBatting',0)->first();

        $batting_team_id = optional($batting_team)->team_id;
        $bowling_team_id = optional($bowling_team)->team_id;
        $isOver = optional($batting_team)->isOver;
        $current_over = optional($batting_team)->over;
        $current_overball = optional($batting_team)->overball;

        $overs = MatchTrack::select('action','over','overball')->where('match_id', $id)->where('team_id', $batting_team_id)->where('tournament_id', $tournament)
            ->orderBy('over', 'desc')
            ->orderBy('overball', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()->take(12);
        $over = $overs->reverse();

        $opening = false;
        $any_batsman = $game->MatchPlayers->where('team_id',$batting_team_id)->where('bt_status','!=','DNB')->first();
        if($any_batsman){
            $opening = true;
        }

        $target = NULL;
        if ($game->status == 3) {
            $team = $game->MatchDetail->where('isBatting', 0)->first();
            $target = $team ? $team->score + 1 : NULL;
        }

        $batting_team = $game->MatchDetail->where('isBatting', 1)->first();
        $batting_team_score = $batting_team ? $batting_team->score : NULL;

        $current_batsman = $game->MatchPlayers->whereIn('bt_status', ['10','11'])->where('team_id', $batting_team_id)->sortBy('bt_order');
        $current_bowler = $game->MatchPlayers->where('bw_status', '11')->where('team_id', '<>', $batting_team_id)->first();

        $notout_batsman = $game->MatchPlayers->whereIn('bt_status', ['DNB', '12'])->where('team_id', $batting_team_id)->sortBy(function($player){
            return array_search($player->Players->role_id, [1,3,4,5,2]);
        });

        $batting_team_players = $game->MatchPlayers->where('team_id',$batting_team_id)->sortBy(function($player){
            return array_search($player->Players->role_id, [1,3,4,5,2]);
        });

        $bowling_team_players = $game->MatchPlayers->where('team_id',$bowling_team_id)->sortBy(function($player){
            return array_search($player->Players->role_id, [1,3,4,5,2]);
        });

        $status = optional($game)->status;
        $tournament_id = optional($game)->tournament_id;
        $match_id = optional($game)->match_id;

        $mom = NULL;
        if ($game->MOM) $mom = $game->MOM;


        return view('Admin/LiveScore/show', compact('batting_team','status','tournament_id','match_id','batting_team_players','bowling_team_players','mom', 'batting_team_score', 'target', 'over', 'game', 'batting_team_id', 'bowling_team_id', 'opening', 'isOver', 'current_over', 'current_overball', 'current_batsman', 'current_bowler', 'notout_batsman'));
    }

    public function LiveScoreCard($id, $tournament)
    {

        $match = Game::with('MatchDetail','MatchPlayers')->where('match_id', $id)->where('tournament_id', $tournament)->first();

        $match_id = optional($match)->match_id;
        $tournament_id = optional($match)->tournament_id;

        $batting_team = $match->MatchDetail->where('isBatting',1)->first();
        $bowling_team = $match->MatchDetail->where('isBatting',0)->first();
        $batting = optional($batting_team)->team_id;
        $bowling = optional($bowling_team)->team_id;

        $batting_team_players = $match->MatchPlayers->where('team_id',$batting)->sortBy('bt_order');
        $bowling_team_players = $match->MatchPlayers->where('team_id',$bowling);

        return view('Admin/LiveScore/scorecard', compact('match_id','tournament_id','batting','bowling','batting_team','bowling_team','batting_team_players','bowling_team_players'));
    }

    public function MatchData($id, $tournament)
    {
        $data = Game::where('match_id', $id)->where('tournament_id', $tournament)->first();
        return new MatchResource($data);
    }

    public function LiveUpdate(Request $request)
    {

        if ($request->has('value')) {
            if ($request->value == 'W') {
                $request->validate([
                    'wicket_type' => 'required',
                    'bt_team_id' => 'required',
                    'bw_team_id' => 'required',
                    'match_id' => 'required',
                    'tournament' => 'required',
                ]);
                if ($request->wicket_type == "runout") {
                    $request->validate([
                        'batsman_runout' => 'required',
                        'wicket_primary' => 'required',
                        'player_id' => 'required',
                        'non_striker_id' => 'required',
                        'where_batsman_runout' => 'required',
                        'run_scored' => 'required',
                        'attacker_id' => 'required',
                        'newBatsman_id' => 'required_without:all_out',
                    ]);
                } elseif ($request->wicket_type == 'bold' || $request->wicket_type == 'lbw' || $request->wicket_type == 'hitwicket') {
                    $request->validate([
                        'wicket_primary' => 'required',
                        'player_id' => 'required',
                        'newBatsman_id' => 'required_without:all_out',
                    ]);
                }
                elseif ($request->wicket_type == 'catch' || $request->wicket_type == 'stump') {
                    $request->validate([
                        'wicket_primary' => 'required',
                        'player_id' => 'required',
                        'newBatsman_id' => 'required_without:all_out',
                        'wicket_secondary' => 'required',
                    ]);
                }

            }
        }
        if ($request->has('startInning')) {
            if ($request->startInning == 1) {

                $request->validate([
                    'nonstrike_id' => 'required',
                    'strike_id' => 'required',
                    'attacker_id' => 'required',
                    'bt_team_id' => 'required',
                    'bw_team_id' => 'required',
                    'match_id' => 'required',
                    'tournament' => 'required',
                ]);
            }
        }

        if ($request->has('newOver')) {
            if ($request->newOver == 1 || $request->newOver == '1') {
                $request->validate([
                    'newBowler_id' => 'required',
                    'bt_team_id' => 'required',
                    'bw_team_id' => 'required',
                    'match_id' => 'required',
                    'tournament' => 'required',
                ]);
            }
        }


        $match = Game::with('MatchDetail','MatchPlayers')->where('match_id',$request->match_id)->where('tournament_id',$request->tournament)->first();


        if ($request->ajax()) {
            if ($request->startInning) event(new startInningEvent($match,$request));
            if ($request->newOver) event(new newOverEvent($match,$request));

            if ($request->endInning) event(new endInningEvent($match,$request));
            if ($request->resetInning) event(new resetInningEvent($match,$request));
        }

        if ($request->value) {

            if ($request->value == 'W') {
                event(new wicketEvent($match,$request));
                if($request->all_out == 'on'){
                    event(new endInningEvent($match,$request));
                }
            }
            elseif ($request->value == 8) event(new dotBallEvent($match,$request));

            elseif ($request->value == 1) event(new oneRunEvent($match,$request));
            elseif ($request->value == 2) event(new twoRunEvent($match,$request));
            elseif ($request->value == 3) event(new threeRunEvent($match,$request));
            elseif ($request->value == 4) event(new fourRunEvent($match,$request));
            elseif ($request->value == 5) event(new fiveRunEvent($match,$request));
            elseif ($request->value == 6) event(new sixRunEvent($match,$request));

            elseif ($request->value == 'wd') event(new wideZeroRunEvent($match,$request));
            elseif ($request->value == 'wd1') event(new wideOneRunEvent($match,$request));
            elseif ($request->value == 'wd2') event(new wideTwoRunEvent($match,$request));
            elseif ($request->value == 'wd3') event(new wideThreeRunEvent($match,$request));
            elseif ($request->value == 'wd4') event(new wideFourRunEvent($match,$request));

            elseif ($request->value == 'b1') event(new byesOneRunEvent($match,$request));
            elseif ($request->value == 'b2') event(new byesTwoRunEvent($match,$request));
            elseif ($request->value == 'b3') event(new byesThreeRunEvent($match,$request));
            elseif ($request->value == 'b4') event(new byesFourRunEvent($match,$request));

            elseif ($request->value == 'lb1') event(new legByesOneRunEvent($match,$request));
            elseif ($request->value == 'lb2') event(new legByesTwoRunEvent($match,$request));
            elseif ($request->value == 'lb3') event(new legByesThreeRunEvent($match,$request));
            elseif ($request->value == 'lb4') event(new legByesFourRunEvent($match,$request));

            elseif ($request->value == 'nb') event(new noballZeroRunEvent($match,$request));
            elseif ($request->value == 'nb1') event(new noballOneRunEvent($match,$request));
            elseif ($request->value == 'nb2') event(new noballTwoRunEvent($match,$request));
            elseif ($request->value == 'nb3') event(new noballThreeRunEvent($match,$request));
            elseif ($request->value == 'nb4') event(new noballFourRunEvent($match,$request));
            elseif ($request->value == 'nb5') event(new noballFiveRunEvent($match,$request));
            elseif ($request->value == 'nb6') event(new noballSixRunEvent($match,$request));

            elseif ($request->value == 'rh') event(new RetiredHurtBatsmanEvent($match,$request));
            elseif ($request->value == 'sr') event(new strikeRotateEvent($match,$request));


            elseif ($request->value == 'undo' || $request->value == 'reverse_inning') {

                if($request->value == 'reverse_inning'){
                    event(new reverseEndInningEvent($match,$request));

                    $game = Game::where('match_id', $request->match_id)
                        ->where('tournament_id', $request->tournament)->first();

                    if($game->status == 1){
                        $temp = $request->bt_team_id;
                        $request->bt_team_id = $request->bw_team_id;
                        $request->bw_team_id = $temp;
                    }


                    $previous_ball = MatchTrack::where('team_id',$request->bt_team_id)
                        ->where('match_id', $request->match_id)
                        ->where('tournament_id', $request->tournament)
                        ->orderBy('over', 'desc')
                        ->orderBy('overball', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->first();

                    MatchDetail::where('match_id', $request->match_id)
                        ->where('tournament_id', $request->tournament)
                        ->where('team_id', $request->bt_team_id)
                        ->update(['isOver' => 0]);
                }

                else{
                    $previous_ball = MatchTrack::where('team_id', $request->bt_team_id)->where('match_id', $request->match_id)->where('tournament_id', $request->tournament)
                        ->orderBy('over', 'desc')
                        ->orderBy('overball', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->first();
                }



                if (!$previous_ball) return response()->json(['status' => false, 'message' => 'Invalid Option']);
                elseif ($previous_ball->action == 'zero') event(new reverseDotBallEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'one') event(new reverseOneRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'two') event(new reverseTwoRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'three') event(new reverseThreeRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'four') event(new reverseFourRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'five') event(new reverseFiveRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'six') event(new reverseSixRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'wd') event(new reverseWideZeroRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'wd1') event(new reverseWideOneRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'wd2') event(new reverseWideTwoRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'wd3') event(new reverseWideThreeRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'wd4') event(new reverseWideFourRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'wicket') event(new reverseWicketEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'nb') event(new reverseNoballZeroRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'nb1') event(new reverseNoballOneRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'nb2') event(new reverseNoballTwoRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'nb3') event(new reverseNoballThreeRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'nb4') event(new reverseNoballFourRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'nb5') event(new reverseNoballFiveRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'nb6') event(new reverseNoballSixRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'lb1') event(new reverseLegByesOneRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'lb2') event(new reverseLegByesTwoRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'lb3') event(new reverseLegByesThreeRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'lb4') event(new reverseLegByesFourRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'b1') event(new reverseByesOneRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'b2') event(new reverseByesTwoRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'b3') event(new reverseByesThreeRunEvent($match,$request, $previous_ball));
                elseif ($previous_ball->action == 'b4') event(new reverseByesFourRunEvent($match,$request, $previous_ball));
            }


            $match_detail = MatchDetail::where('match_id', $request->match_id)
                ->where('tournament_id', $request->tournament)
                ->where('team_id', $request->bt_team_id)->first();
            $isOver = $match_detail->isOver;
            $isEndInning = false;
            if ($match->overs == $match_detail->over) {
                $isEndInning = true;
            }
            $target = NULL;

            if ($match->status == 3) {
                $team = $match->MatchDetail->where('isBatting', 0)->first();
                $target = $team ? $team->score + 1 : 0;
            }
            $batting_team = $match->MatchDetail->where('isBatting', 1)->first();
            $batting_team_score = $batting_team ? $batting_team->score : NULL;


            return response()->json(['status' => true, 'message' => 'success', 'value' => $request->value, 'isOver' => $isOver, 'isEndInning' => $isEndInning, 'target' => $target, 'batting_team_score' => $batting_team_score]);
        }
    }

    public function select_mom(Request $request)
    {
        $game = Game::where('match_id', $request['match_id'])
            ->where('tournament_id', $request['tournament_id'])
            ->first();

        $game->mom = $request->mom;
        $game->update();

        return back()->with('message', 'Man of the match successfully selected');
    }
}




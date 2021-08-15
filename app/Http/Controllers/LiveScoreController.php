<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
use App\Events\reverseDotBallEvent;
use App\Events\reverseEndInningEvent;
use App\Events\reverseFiveRunEvent;
use App\Events\reverseFourRunEvent;
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
use App\Events\reverseWideZeroRunEvent;
use App\Events\reverseWideOneRunEvent;
use App\Events\reverseWideTwoRunEvent;
use App\Events\reverseWideThreeRunEvent;
use App\Events\reverseWideFourRunEvent;
use App\Events\reverseLegByesOneRunEvent;
use App\Events\reverseLegByesTwoRunEvent;
use App\Events\reverseLegByesThreeRunEvent;
use App\Events\reverseLegByesFourRunEvent;
use App\Events\reverseByesOneRunEvent;
use App\Events\reverseByesTwoRunEvent;
use App\Events\reverseByesThreeRunEvent;
use App\Events\reverseByesFourRunEvent;
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

        return view('Admin/LiveScore/StartScore', compact('schedule', 'players1', 'players2'));
    }

    public function ScoreDetails(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'overs' => 'required',
            'tournament_id' => 'required',
            'toss' => 'required',
            'choose' => 'required',
            'team1' => 'required|array',
            'team2' => 'required|array',
        ]);
//        return $request->all();

        DB::transaction(function () use ($request) {
            $m = Game::create([
                'match_id' => request('id'),
                'overs' => request('overs'),
                'tournament_id' => request('tournament_id'),
                'toss' => request('toss'),
                'choose' => request('choose'),
            ]);

            if ($request->choose == 'Bat')
                if ($request->toss == $request->team1_id) {
                    MatchDetail::create([
                        'match_id' => $m->match_id,
                        'team_id' => request('team1_id'),
                        'isBatting' => 1,
                        'tournament_id' => request('tournament_id'),
                    ]);

                    MatchDetail::create([
                        'match_id' => $m->match_id,
                        'team_id' => request('team2_id'),
                        'isBatting' => 0,
                        'tournament_id' => request('tournament_id'),
                    ]);
                } else {
                    MatchDetail::create([
                        'match_id' => $m->match_id,
                        'team_id' => request('team1_id'),
                        'isBatting' => 0,
                        'tournament_id' => request('tournament_id'),
                    ]);

                    MatchDetail::create([
                        'match_id' => $m->match_id,
                        'team_id' => request('team2_id'),
                        'isBatting' => 1,
                        'tournament_id' => request('tournament_id'),
                    ]);
                }

            else {
                if ($request->toss == $request->team1_id) {
                    MatchDetail::create([
                        'match_id' => $m->match_id,
                        'team_id' => request('team1_id'),
                        'isBatting' => 0,
                        'tournament_id' => request('tournament_id'),
                    ]);

                    MatchDetail::create([
                        'match_id' => $m->match_id,
                        'team_id' => request('team2_id'),
                        'isBatting' => 1,
                        'tournament_id' => request('tournament_id'),
                    ]);
                } else {
                    MatchDetail::create([
                        'match_id' => $m->match_id,
                        'team_id' => request('team1_id'),
                        'isBatting' => 1,
                        'tournament_id' => request('tournament_id'),
                    ]);

                    MatchDetail::create([
                        'match_id' => $m->match_id,
                        'team_id' => request('team2_id'),
                        'isBatting' => 0,
                        'tournament_id' => request('tournament_id'),
                    ]);
                }
            }

            foreach ($request->team1 as $t1) {
                MatchPlayers::create([
                    'match_id' => $m->match_id,
                    'player_id' => $t1,
                    'team_id' => $request->team1_id,
                    'tournament_id' => request('tournament_id'),
                ]);
            }
            foreach ($request->team2 as $t2) {
                MatchPlayers::create([
                    'match_id' => $m->match_id,
                    'player_id' => $t2,
                    'team_id' => $request->team2_id,
                    'tournament_id' => request('tournament_id'),
                ]);
            }
        });


        return redirect('/admin/tournaments/' . request('tournament_id') . '/schedules');
    }


    public function LiveUpdateShow($id, $tournament)
    {


        $game = Game::where('match_id', $id)->where('tournament_id', $tournament)->first();

        if ($game->MatchDetail['0']->isBatting == 1) {
            $batting_team_id = $game->MatchDetail['0']->team_id;
            $bowling_team_id = $game->MatchDetail['1']->team_id;

            $isOver = $game->MatchDetail['0']->isOver;
            $current_over = $game->MatchDetail['0']->over;
            $current_overball = $game->MatchDetail['0']->overball;
        } else {
            $batting_team_id = $game->MatchDetail['1']->team_id;
            $bowling_team_id = $game->MatchDetail['0']->team_id;

            $isOver = $game->MatchDetail['1']->isOver;
            $current_over = $game->MatchDetail['1']->over;
            $current_overball = $game->MatchDetail['1']->overball;
        }

        $over = MatchTrack::where('match_id', $id)->where('team_id',$batting_team_id)->where('tournament_id', $tournament)
            ->orderBy('over', 'desc')
            ->orderBy('overball', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()->take(10);
        $over = $over->reverse();

        //check for opening
        $opening = true;
        foreach ($game->MatchPlayers as $mp) {
            if ($mp->team_id == $batting_team_id)
                if ($mp->bt_status == 10 || $mp->bt_status == 11)
                    $opening = false;
        }
        $target = null;
        if($game->status == 3){
            $team = $game->MatchDetail->where('isBatting',0)->first();
            $target = $team ? $team->score + 1 : 0;
        }

        $batting_team = $game->MatchDetail->where('isBatting',1)->first();
        $batting_team_score = $batting_team ? $batting_team->score : NULL;


        $current_batsman = MatchPlayers::whereIn('bt_status', ['10', '11'])->where('team_id', $batting_team_id)->where('match_id', $id)->where('tournament_id', $tournament)->orderBy('bt_order', 'asc')->get();
        $current_bowler = MatchPlayers::where('bw_status', '11')->where('team_id', '<>', $batting_team_id)->where('match_id', $id)->where('tournament_id', $tournament)->first();

        $notout_batsman = MatchPlayers::whereIn('bt_status', ['DNB', '12'])->where('team_id', $batting_team_id)->where('match_id', $id)->where('tournament_id', $tournament)->get();
        return view('Admin/LiveScore/show', compact('batting_team_score','target','over', 'game', 'batting_team_id', 'bowling_team_id', 'opening', 'isOver', 'current_over','current_overball', 'current_batsman', 'current_bowler', 'notout_batsman'));
    }

    public function LiveScoreCard($id, $tournament)
    {

        $matchs = Game::where('match_id', $id)->where('tournament_id', $tournament)->first();

        return view('Admin/LiveScore/scorecard', compact('matchs'));
    }

    public function MatchData($id, $tournament)
    {
        $data = Game::where('match_id', $id)->where('tournament_id', $tournament)->first();
        return new MatchResource($data);
    }

    public function LiveUpdate(Request $request)
    {

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
            if($request->newOver == 1 || $request->newOver == '1'){
                $request->validate([
                    'newBowler_id' => 'required',
                    'bt_team_id' => 'required',
                    'bw_team_id' => 'required',
                    'match_id' => 'required',
                    'tournament' => 'required',
                ]);
            }
        }


        if ($request->ajax()) {
            if ($request->startInning) event(new startInningEvent($request));
            if ($request->newOver) event(new newOverEvent($request));

            if ($request->endInning) event(new endInningEvent($request));
            if ($request->resetInning) event(new resetInningEvent($request));
        }

        if ($request->value) {

            if ($request->value == 'W') {
                event(new wicketEvent($request));
            }
            if ($request->value == 8) event(new dotBallEvent($request));

            if ($request->value == 1) event(new oneRunEvent($request));
            if ($request->value == 2) event(new twoRunEvent($request));
            if ($request->value == 3) event(new threeRunEvent($request));
            if ($request->value == 4) event(new fourRunEvent($request));
            if ($request->value == 5) event(new fiveRunEvent($request));
            if ($request->value == 6) event(new sixRunEvent($request));

            if ($request->value == 'wd') event(new wideZeroRunEvent($request));
            if ($request->value == 'wd1') event(new wideOneRunEvent($request));
            if ($request->value == 'wd2') event(new wideTwoRunEvent($request));
            if ($request->value == 'wd3') event(new wideThreeRunEvent($request));
            if ($request->value == 'wd4') event(new wideFourRunEvent($request));

            if ($request->value == 'b1') event(new byesOneRunEvent($request));
            if ($request->value == 'b2') event(new byesTwoRunEvent($request));
            if ($request->value == 'b3') event(new byesThreeRunEvent($request));
            if ($request->value == 'b4') event(new byesFourRunEvent($request));

            if ($request->value == 'lb1') event(new legByesOneRunEvent($request));
            if ($request->value == 'lb2') event(new legByesTwoRunEvent($request));
            if ($request->value == 'lb3') event(new legByesThreeRunEvent($request));
            if ($request->value == 'lb4') event(new legByesFourRunEvent($request));

            if ($request->value == 'nb') event(new noballZeroRunEvent($request));
            if ($request->value == 'nb1') event(new noballOneRunEvent($request));
            if ($request->value == 'nb2') event(new noballTwoRunEvent($request));
            if ($request->value == 'nb3') event(new noballThreeRunEvent($request));
            if ($request->value == 'nb4') event(new noballFourRunEvent($request));
            if ($request->value == 'nb5') event(new noballFiveRunEvent($request));
            if ($request->value == 'nb6') event(new noballSixRunEvent($request));

            if ($request->value == 'rh') event(new RetiredHurtBatsmanEvent($request));
            if ($request->value == 'sr') event(new strikeRotateEvent($request));

            if ($request->value == 'reverse_inning') event(new reverseEndInningEvent($request));

            if ($request->value == 'undo') {
                $previous_ball = MatchTrack::where('team_id', $request->bt_team_id)->where('match_id', $request->match_id)->where('tournament_id', $request->tournament)
                    ->orderBy('over', 'desc')
                    ->orderBy('overball', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($previous_ball->action == 'zero') event(new reverseDotBallEvent($request, $previous_ball));
                if ($previous_ball->action == 'one') event(new reverseOneRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'two') event(new reverseTwoRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'three') event(new reverseThreeRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'four') event(new reverseFourRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'five') event(new reverseFiveRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'six') event(new reverseSixRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'wd') event(new reverseWideZeroRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'wd1') event(new reverseWideOneRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'wd2') event(new reverseWideTwoRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'wd3') event(new reverseWideThreeRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'wd4') event(new reverseWideFourRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'wicket') event(new reverseWicketEvent($request, $previous_ball));
                if ($previous_ball->action == 'nb') event(new reverseNoballZeroRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'nb1') event(new reverseNoballOneRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'nb2') event(new reverseNoballTwoRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'nb3') event(new reverseNoballThreeRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'nb4') event(new reverseNoballFourRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'nb5') event(new reverseNoballFiveRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'nb6') event(new reverseNoballSixRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'lb1') event(new reverseLegByesOneRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'lb2') event(new reverseLegByesTwoRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'lb3') event(new reverseLegByesThreeRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'lb4') event(new reverseLegByesFourRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'b1') event(new reverseByesOneRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'b2') event(new reverseByesTwoRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'b3') event(new reverseByesThreeRunEvent($request, $previous_ball));
                if ($previous_ball->action == 'b4') event(new reverseByesFourRunEvent($request, $previous_ball));
            }


            $match = Game::where('match_id', $request->match_id)
                ->where('tournament_id', $request->tournament)->first();
            $match_detail = MatchDetail::where('match_id', $request->match_id)
                ->where('tournament_id', $request->tournament)
                ->where('team_id', $request->bt_team_id)->first();
            $isOver = $match_detail->isOver;
            $isEndInning = false;
            if($match->overs == $match_detail->over){
                $isEndInning = true;
            }
            $target = NULL;

            if($match->status == 3){
                $team = $match->MatchDetail->where('isBatting',0)->first();
                $target = $team ? $team->score + 1 : 0;
            }
            $batting_team = $match->MatchDetail->where('isBatting',1)->first();
            $batting_team_score = $batting_team ? $batting_team->score : NULL;



            return response()->json(['message' => 'success', 'value' => $request->value, 'isOver' => $isOver,'isEndInning' => $isEndInning,'target' => $target,'batting_team_score' => $batting_team_score]);
        }
    }

    public function select_mom(Request $request)
    {
        $game = Game::where('match_id', $request['match_id'])
            ->where('tournament_id', $request['tournament_id'])
            ->first();

        $game->mom = $request->mom;
        $game->save();

        return back()->with('message', 'Man of the match successfully selected');
    }
}




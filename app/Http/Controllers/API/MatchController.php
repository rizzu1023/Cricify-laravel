<?php

namespace App\Http\Controllers\API;

use App\Game;
use App\Http\Controllers\Controller;
use App\Http\Resources\FowResource;
use App\Http\Resources\MatchDetailResource;
use App\Http\Resources\MatchPlayersResource;
use App\Http\Resources\MatchTrackResource;
use App\Http\Resources\PlayersResource;
use App\Http\Resources\TeamResource;
use App\MatchDetail;
use App\MatchPlayers;
use App\MatchTrack;
use App\Models\Advertise;
use App\Schedule;
use App\Teams;
use App\Tournament;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MatchController extends Controller
{

    public function advertise($page, $tournament_id)
    {
        $url = NULL;
        $height = 100;
        $advertise = Advertise::where('status', 1)->where('page', $page)->first();
        if ($advertise) {
            if (!is_null($tournament_id)) {
                if ($tournament_id == $advertise->tournament_id) {
                    $url = $advertise->getFirstMedia('advertise-image') ? $advertise->getFirstMedia('advertise-image')->getUrl('compressed-image') : NULL;
                    $height = $advertise->height;
                }
            }
            else{
                $url = $advertise->getFirstMedia('advertise-image') ? $advertise->getFirstMedia('advertise-image')->getUrl('compressed-image') : NULL;
                $height = $advertise->height;
                }
            }


        return ['url' => $url, 'height' => $height];
    }


    public function matchInfo(Tournament $tournament, $match_id)
    {
        $schedule = Schedule::with('Game', 'Teams1', 'Teams2')->where('id', $match_id)->where('tournament_id', $tournament->id)->first();

        $team1 = new TeamResource($schedule->Teams1);
        $team2 = new TeamResource($schedule->Teams2);

        $format_time = Carbon::parse($schedule->times)->format('h:i A');
        $format_date = Carbon::parse($schedule->dates)->format('d M Y');
        $day = strtoupper(Carbon::parse($schedule->dates)->format('l'));

        $toss = $schedule->Game;
        $toss_team = NULL;
        $venue = NULL;
        $choose = NULL;
        $umpires = NULL;
        $overs = NULL;
        if ($schedule->Game) {
            $overs = (int)$schedule->Game->overs;
            if ($schedule->Game->umpire_1 && $schedule->Game->umpire_2) {
                $umpires = $schedule->Game->umpire_1 . ' , ' . $schedule->Game->umpire_2;
            } elseif ($schedule->Game->umpire_1) {
                $umpires = $schedule->Game->umpire_1;
            } elseif ($schedule->Game->umpire_2) {
                $umpires = $schedule->Game->umpire_2;
            }
        }


        if ($toss) {
            $toss_team = $team1->id == $toss->toss ? $team1 : $team2;
            $choose = $toss->choose == 'Bat' ? 'Batting' : 'Bowling';

            return [
                'match_status' => true,
                'team1' => $team1,
                'team2' => $team2,
                'match' => $schedule->match_no,
                'tournament' => $tournament->tournament_name,
                'dates' => $format_date,
                'day' => $day,
                'times' => $format_time,
                'toss' => $toss_team,
                'choose' => $choose,
                'over' => $overs,
                'umpires' => $umpires,
                'venue' => $venue,
            ];
        }

        return [
            'match_status' => false,
            'team1' => $team1,
            'team2' => $team2,
            'match' => $schedule->match_no,
            'tournament' => $tournament->tournament_name,
            'dates' => $format_date,
            'day' => $day,
            'times' => $format_time,
            'overs' => $overs,
            'umpires' => $umpires,
            'venue' => $venue,
        ];
    }

    public function matchLive(Tournament $tournament, $match_id)
    {
        $advertise = $this->advertise('live', $tournament->id);

        $match = Game::with(['MatchDetail','MOM','WON','MatchTracks', 'MatchPlayers' => function ($query) {
            return $query->with('media', 'Role', 'BattingStyle', 'BowlingStyle');
        }])->where('match_id', $match_id)->where('tournament_id', $tournament->id)->first();


//        with(['Players' => function ($query) {
//                        return $query->with('media', 'Role', 'BattingStyle', 'BowlingStyle');
//                    }, 'wicketPrimary', 'wicketSecondary'])
//        $schedule = Schedule::with('Game', 'Teams1', 'Teams2')->where('id', $match_id)->where('tournament_id', $tournament->id)->first();


        if ($match) {
            $batting_team = $match->MatchDetail->where('isBatting', 1)->first();
            $batting_team_id = optional($batting_team)->team_id;
            $bowling_team = $match->MatchDetail->where('isBatting', 0)->first();
            $bowling_team_id = optional($bowling_team)->team_id;


            $match_status = $match->status;

            if ($match_status == 0) {
                return [
                    'isMatch' => 'not_found',
                    'match_status' => $match_status,
                ];

            } elseif ($match_status == 4) {

                $won = $match->WON;
                $mom = $match->MOM;
                return [
                    'match_status' => $match_status,
                    'team1' => new MatchDetailResource($batting_team),
                    'team2' => new MatchDetailResource($bowling_team),
                    'won_match_detail' => $match,
                    'won' => $won ? TeamResource::make($won) : NULL,
                    'mom' => $mom ? PlayersResource::make($mom) : NULL,
                    'advertise_url' => $advertise['url'],
                    'advertise_height' => $advertise['height'],
                ];
            } else {
                $total_overs = $match->overs;
                $match_detail = NULL;

                $current_batsman = [];
                $current_bowler = NULL;
                $target = $bowling_team->score;


                if ($batting_team) {
                    $match_detail = new MatchDetailResource($batting_team);
                    $batsman = $match->MatchPlayers->whereIn('bt_status', ['10', '11'])->where('team_id', $batting_team_id)->sortByDesc('bt_order');
//                    $batsman = MatchPlayers::with(['Players.media' => function ($query) {
//                        return $query->with('media', 'Role', 'BattingStyle', 'BowlingStyle');
//                    }, 'wicketPrimary', 'wicketSecondary'])->whereIn('bt_status', ['10', '11'])->where('team_id', $batting_team->team_id)->where('match_id', $match_id)->where('tournament_id', $tournament->id)->orderBy('bt_order', 'asc')->get();
                    $current_batsman = MatchPlayersResource::collection($batsman);

                    $bowler = $match->MatchPlayers->where('bw_status', '11')->where('team_id', $bowling_team_id)->first();

//                    $bowler = MatchPlayers::with(['Players' => function ($query) {
//                        return $query->with('media', 'Role', 'BattingStyle', 'BowlingStyle');
//                    }, 'wicketPrimary', 'wicketSecondary'])->where('bw_status', '11')->where('team_id', '<>', $batting_team->team_id)->where('match_id', $match_id)->where('tournament_id', $tournament->id)->first();
                    if ($bowler)
                        $current_bowler = new MatchPlayersResource($bowler);
//                else
//                    $current_bowler = 'not_found';

                    $batting_team_overs = $batting_team->over;
                    $batting_team_balls = $batting_team->overball;
                    //calculating remaining ball of current team
                    $remaining_balls = calculateBalls($total_overs, $batting_team_overs, 0, $batting_team_balls);


                    $partnership = [];

                    $partnership_query = $match->MatchTracks->whereIn('wickets', [$batting_team->wicket - 1, $batting_team->wicket])->where('team_id', $batting_team_id)->sorBy('wickets')->sortBy('score')->sortBy('over')->sortBy('overball');

                    $p0 = $partnership_query->where('wickets', $match_detail->wicket - 1)->last();
                    $p1 = $partnership_query->where('wickets', $match_detail->wicket)->last();

                    if ($p1) {
                        if ($p1 && $p0) {
                            $score = $p1->score - $p0->score;
                            $balls = calculateBalls($p1->over, $p0->over, $p1->overball, $p0->overball + 1);
                            $partnership['score'] = $score;
                            $partnership['balls'] = $balls;
                        } else {
                            $score = $p1->score - 0;
                            $balls = calculateBalls($p1->over, 0, $p1->overball, 0);
                            $partnership['score'] = $score;
                            $partnership['balls'] = $balls;
                        }
                    } else {
                        $partnership['score'] = 0;
                        $partnership['balls'] = 0;
                    }


                }
                $remaining_runs = $target - $batting_team->score + 1;
                $crr = calculateCRR($batting_team->score, $batting_team->over, $batting_team->overball);
                $rrr = calculateRRR($remaining_runs, $remaining_balls);

                //only when inning breaks
                if ($match_status == 2) {
                    $match_detail = new MatchDetailResource($bowling_team);
                }


                return [
//                'isMatch' => true,
                    'partnership' => $partnership,
                    'match_detail' => $match_detail,
                    'current_batsman' => $current_batsman,
                    'current_bowler' => $current_bowler,
                    'match_status' => $match_status,
                    'target' => $target + 1,
                    'remaining_balls' => $remaining_balls,
                    'remaining_runs' => $remaining_runs,
                    'crr' => $crr,
                    'rrr' => $rrr,
                    'advertise_url' => $advertise['url'],
                    'advertise_height' => $advertise['height'],
                ];

            }
        } else {
            return [
                'isMatch' => 'not_found',
                'match_status' => 0,
            ];
        }
    }


    public function matchScorecard(Tournament $tournament, $match_id)
    {
        $schedule = Schedule::with('Game', 'Teams1', 'Teams2')->where('id', $match_id)->where('tournament_id', $tournament->id)->first();

        $team1_id = $schedule->Teams1->id;
        $team2_id = $schedule->Teams2->id;

        $team_query = Teams::whereIn('id', [$team1_id, $team2_id])->get();


        $isMatch = 'not_found';
        $toss_winning_team = NULL;
        $match_status = null;
        $match = $schedule->Game;


        if ($match) {
            if ($match->WON) {
                $team_won = $match->WON->team_name;
                $won_description = $match->description;
            } else
                $team_won = '0';
            $won_description = '';

        } else
            $team_won = '';
        $won_description = '';


        if ($match) {
            if ($match->status > 0) {
                $isMatch = true;
                $match_status = $match->status;
            }

            $toss_winning_team = $team_query->where('id', $match->toss)->first();
            if (($match->toss == $team1_id && $match->choose == 'Bat') || ($match->toss == $team2_id && $match->choose == 'Bowl')) {
                $batting_team_id = $team1_id;
                $bowling_team_id = $team2_id;
            } else {
                $batting_team_id = $team2_id;
                $bowling_team_id = $team1_id;
            }
        }

        $team1_detail = NULL;
        $team1_batsman = [];
        $team1_notout_batsman = [];
        $team1_bowler = [];
        $team1_extras = NULL;
        $team1_score = NULL;
        $team1_fow = NULL;

        $team2_detail = NULL;
        $team2_batsman = [];
        $team2_notout_batsman = [];
        $team2_bowler = [];
        $team2_extras = NULL;
        $team2_score = NULL;
        $team2_fow = NULL;


        if ($match) {
            $match_players_query = MatchPlayers::with(['Players' => function ($query) {
                return $query->with('media', 'Role', 'BattingStyle', 'BowlingStyle');
            }, 'wicketPrimary', 'wicketSecondary'])->where('match_id', $match_id)->where('tournament_id', $tournament->id)->orderBy('bt_order', 'asc')->get();
            $match_details_query = MatchDetail::select('score', 'wicket', 'over', 'overball', 'no_ball', 'wide', 'byes', 'legbyes', 'team_id')->where('match_id', $match_id)->where('tournament_id', $tournament->id)->get();
            $match_track_query = MatchTrack::with('Batsman')->select('player_id', 'score', 'wickets', 'over', 'overball', 'team_id')->where('action', 'wicket')->where('match_id', $match_id)->where('tournament_id', $tournament->id)->orderBy('wickets', 'asc')->get();


            $team1_detail = $team_query->where('id', $batting_team_id)->first();
            $team1_batsman = $match_players_query->whereIn('bt_status', ['0', '10', '11', '12'])->where('team_id', $batting_team_id);
            $team1_notout_batsman = $match_players_query->where('bt_status', 'DNB')->where('team_id', $batting_team_id);
            $team1_bowler = $match_players_query->whereIn('bw_status', ['1', '11'])->where('team_id', $bowling_team_id);
            $team1_extras = $match_details_query->where('team_id', $batting_team_id)->first();
            $team1_score = $match_details_query->where('team_id', $batting_team_id)->first();
            $team1_fow = $match_track_query->where('team_id', $batting_team_id);


            $team2_detail = $team_query->where('id', $bowling_team_id)->first();
            $team2_batsman = $match_players_query->whereIn('bt_status', ['0', '10', '11', '12'])->where('team_id', $bowling_team_id);
            $team2_notout_batsman = $match_players_query->where('bt_status', 'DNB')->where('team_id', $bowling_team_id);
            $team2_bowler = $match_players_query->whereIn('bw_status', ['1', '11'])->where('team_id', $batting_team_id);
            $team2_extras = $match_details_query->where('team_id', $bowling_team_id)->first();
            $team2_score = $match_details_query->where('team_id', $bowling_team_id)->first();
            $team2_fow = $match_track_query->where('team_id', $bowling_team_id);
        }


        if (is_null($team1_fow)) $team1_fow = null;
        else $team1_fow = FowResource::collection($team1_fow);
        if (is_null($team2_fow)) $team2_fow = null;
        else $team2_fow = FowResource::collection($team2_fow);


        return [
            'isMatch' => $isMatch,
            'won' => $team_won,
            'description' => $won_description,
            'match_status' => $match_status,
            'toss_winning_team' => $toss_winning_team,
            'match_detail' => $match,
            'team1' => [
                'detail' => $team1_detail,
                'batsman' => MatchPlayersResource::collection($team1_batsman),
                'notout_batsman' => MatchPlayersResource::collection($team1_notout_batsman),
                'bowler' => MatchPlayersResource::collection($team1_bowler),
                'extras' => $team1_extras,
                'score' => $team1_score,
                'fow' => $team1_fow,
            ],
            'team2' => [
                'detail' => $team2_detail,
                'batsman' => MatchPlayersResource::collection($team2_batsman),
                'notout_batsman' => MatchPlayersResource::collection($team2_notout_batsman),
                'bowler' => MatchPlayersResource::collection($team2_bowler),
                'extras' => $team2_extras,
                'score' => $team2_score,
                'fow' => $team2_fow,
            ],
        ];

    }

    public function matchOvers(Tournament $tournament, $match_id)
    {
        $schedule = Schedule::with('Game.MatchDetail', 'Teams1', 'Teams2')->where('id', $match_id)->where('tournament_id', $tournament->id)->first();

        $game = $schedule->Game;

        if ($game) {

            if (!$game->status > 0) {
                return [
                    'isMatch' => 'not_found',
                ];
            } else {

                $batting_team = $game->MatchDetail->where('isBatting', 1)->first();
                $batting_team_id = optional($batting_team)->team_id;
                $bowling_team = $game->MatchDetail->where('isBatting', 0)->first();
                $bowling_team_id = optional($bowling_team)->team_id;


                $overs = MatchTrack::with('Players', 'Batsman')->select('over', DB::raw('Min(attacker_id) as attacker_id, SUM(wickets) as wickets,SUM(run) as runs'))
                    ->groupBy('over')
                    ->where('match_id', $match_id)
                    ->where('team_id', $batting_team_id)
                    ->where('tournament_id', $tournament->id)
                    ->orderBy('over', 'desc')
                    ->get();


                $over_detail = MatchTrack::select('over', 'action', 'run', 'overball')
                    ->where('match_id', $match_id)
                    ->where('team_id', $batting_team_id)
                    ->where('tournament_id', $tournament->id)
                    ->orderBy('over', 'desc')
                    ->orderBy('overball', 'asc')
                    ->get();

                $result_collection = MatchTrackResource::collection($overs);
                $over_details = collect($over_detail)->groupBy('over');
                $result = collect();
                foreach ($result_collection as $rc) {
                    $r = collect($rc)->merge(['over_detail' => $over_details[$rc->over]]);
                    $result->push($r);
                }

//            return $result_collection;

//            $overs2 = MatchTrack::selectRaw('Min(attacker_id) as attacker_id, SUM(run) as runs, SUM(wickets) as wickets ',)
//                ->groupBy('over')
//                ->where('match_id', $match_id)
//                ->where('team_id', $batting_team_id)
//                ->where('tournament_id', $tournament->id)
//                ->orderBy('over', 'desc')
//                ->get();

                $overs2 = MatchTrack::with('Players', 'Batsman')->select('over', DB::raw('Min(attacker_id) as attacker_id, SUM(wickets) as wickets,SUM(run) as runs'))
                    ->groupBy('over')
                    ->where('match_id', $match_id)
                    ->where('team_id', $bowling_team_id)
                    ->where('tournament_id', $tournament->id)
                    ->orderBy('over', 'desc')
                    ->get();

                $over_detail2 = MatchTrack::select('over', 'action', 'run', 'overball')
                    ->where('match_id', $match_id)
                    ->where('team_id', $bowling_team_id)
                    ->where('tournament_id', $tournament->id)
                    ->orderBy('over', 'desc')
                    ->orderBy('overball', 'asc')
                    ->get();

                $result_collection2 = MatchTrackResource::collection($overs2);
                $over_details2 = collect($over_detail2)->groupBy('over');
                $result2 = collect();
                foreach ($result_collection2 as $rc) {
                    $r = collect($rc)->merge(['over_detail' => $over_details2[$rc->over]]);
                    $result2->push($r);
                }

                return [
                    'isMatch' => true,
                    'overs' => $result->merge($result2),
                ];

            }
        } else {
            return [
                'isMatch' => 'not_found',
            ];
        }


    }
}

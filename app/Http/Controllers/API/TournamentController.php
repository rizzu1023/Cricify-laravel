<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupTeamResource;
use App\Http\Resources\PointsTableResource;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\TeamResource;
use App\Http\Resources\TournamentResource;
use App\Jobs\StoreAppUserIPJob;
use App\Models\Group;
use App\Models\GroupTeam;
use App\Schedule;
use App\Teams;
use App\Tournament;
use Illuminate\Http\Request;
use App\Models\AppUser;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        StoreAppUserIPJob::dispatch($request->ip());

        $tournaments = Tournament::where('status',1)->orderBy('start_date','desc')->get();
        return TournamentResource::collection($tournaments);
    }


    public function schedules(Tournament $tournament)
    {
        $schedule = Schedule::where('tournament_id',$tournament->id)->get();
        return ScheduleResource::collection($schedule);
    }


    public function teams(Tournament $tournament)
    {
        $team = Teams::where('tournament_id',$tournament->id)->where('status',1)->get();
        return TeamResource::collection($team);
    }


    public function points_table(Tournament $tournament)
    {
        $groups = Group::where('tournament_id',$tournament->id)->orderBy('group_name','asc')->get();
        $points_table = collect();
        foreach ($groups as $g){
            $teams = GroupTeam::where('tournament_id',$g->tournament_id)->where('group_id',$g->id)->orderBy('points','desc')->orderBy('nrr','desc')->get();
            $t = GroupTeamResource::collection($teams);
            $points_table->push(['group_name' => $g->group_name, 'teams' => $t]);
        }
        return PointsTableResource::collection($points_table);
    }


}

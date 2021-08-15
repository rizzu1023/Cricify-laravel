<?php

namespace App\Listeners;

use App\Events\resetInningEvent;
use App\Game;
use App\MatchDetail;
use App\MatchPlayers;
use App\MatchTrack;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class resetInningListener
{
    /**
     * Create the event listener.
     *
     * @param $event
     */
    public function __construct()
    {



    }

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {

        $game = Game::where('match_id',$event->request->match_id)
            ->where('tournament_id',$event->request->tournament)
            ->first();

        if($game->status == 1 || $game->status == 3){
            $game->status = $game->status - 1;
            $game->update();

            $batting_team = MatchDetail::where('match_id',$event->request->match_id)
                ->where('tournament_id',$event->request->tournament)
                ->where('team_id',$event->request->bt_team_id)
                ->first();

            $batting_team->score = 0;
            $batting_team->wicket = 0;
            $batting_team->over = 0;
            $batting_team->overball = 0;
            $batting_team->no_ball = 0;
            $batting_team->wide = 0;
            $batting_team->byes = 0;
            $batting_team->legbyes = 0;
            $batting_team->isOver = 0;
            $batting_team->save();

            $batting_team_players = MatchPlayers::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id', $event->request->bt_team_id)->get();

            $bowling_team_players = MatchPlayers::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id', $event->request->bw_team_id)->get();

            foreach ($batting_team_players as $player){
                $player->bt_status = 'DNB';
                $player->bt_runs = 0;
                $player->bt_balls = 0;
                $player->bt_fours = 0;
                $player->bt_sixes = 0;
                $player->bt_order = 100;
                $player->wicket_type = '--';
                $player->wicket_primary = '--';
                $player->wicket_secondary = '--';
                $player->save();
            }

            foreach ($bowling_team_players as $player){
                $player->bw_status = 'DNB';
                $player->bw_over = 0;
                $player->bw_overball = 0;
                $player->bw_wickets = 0;
                $player->bw_runs = 0;
                $player->bw_maiden = 0;
                $player->bw_nb = 0;
                $player->bw_wide = 0;
                $player->save();
            }

            $batting_team_match_track = MatchTrack::where('match_id', $event->request->match_id)
                ->where('tournament_id', $event->request->tournament)
                ->where('team_id', $event->request->bt_team_id)->get();

            foreach ($batting_team_match_track as $mt){
                $mt->delete();
            }
        }


    }
}

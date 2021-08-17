<?php

namespace App\Listeners;

use App\Events\strikeRotateEvent;
use App\MatchPlayers;
use App\MatchTrack;

class isOverForBowler
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param strikeRotateEvent $event
     * @return void
     */
    public function handle($event)
    {

        $match = $event->match;
        $bowling_team = $match->MatchDetail->where('isBatting', 0)->first();
        $batting_team = $match->MatchDetail->where('isBatting', 1)->first();
        $bowling_team_id = optional($bowling_team)->team_id;
        $batting_team_id = optional($batting_team)->team_id;
        $attacker = $match->MatchPlayers->where('team_id', $bowling_team_id)->where('bw_status', 11)->first();

        if ($attacker->bw_overball > 5) {

            $attacker->update([
                'bw_overball' => 0,
                'bw_over' => $attacker->bw_over + 1,
            ]);

            $tracks = $match->MatchTracks->where('attacker_id',$attacker->player_id)->where('team_id',$batting_team_id)->where('over',$batting_team->over);
            $actions = ['one','two','three','four','five','six','wd','wd1','wd2','wd3','wd4','nb','nb1','nb2','nb3','nb4','nb5','nb6'];
            $check_for_maiden = $tracks->whereIn('action',$actions)->first();
            if(!$check_for_maiden){
                $attacker->bw_maiden += 1;
                $attacker->update();
            }
        }
    }
}

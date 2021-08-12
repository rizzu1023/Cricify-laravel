<?php

namespace App\Imports;

use App\Models\MasterBattingStyle;
use App\Models\MasterBowlingStyle;
use App\Models\MasterRole;
use App\Batting;
use App\Bowling;
use App\Players;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PlayerImport implements ToModel, WithHeadingRow, WithValidation
{
    private $user,$team;

    public function __construct($user,$team)
    {
        $this->user = $user;
        $this->team = $team;
    }

    public function model(array $row)
    {
        $role = MasterRole::where('name',$row['role'])->firstOrCreate([
            'name' => $row['role'],
            'status' => 1,
        ]);

        $battingStyle = MasterBattingStyle::where('name',$row['batting_style'])->firstOrCreate([
            'name' => $row['batting_style'],
            'status' => 1,
        ]);

        $bowlingStyle = MasterBowlingStyle::where('name',$row['bowling_style'])->firstOrCreate([
            'name' => $row['bowling_style'],
            'status' => 1,
        ]);

        $player =  Players::create([
            'player_id' => $row['player_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'role_id' => $role->id,
            'batting_style_id' => $battingStyle->id,
            'bowling_style_id' => $bowlingStyle->id,
//            'dob' => $row['dob'],
            'user_id' => $this->user->id,
        ]);

        if(!is_null($this->team)){
            $player->Teams()->syncWithoutDetaching($this->team);
        }

        Batting::create([
            'player_id' => $player->player_id,
        ]);

        Bowling::create([
            'player_id' => $player->player_id,
        ]);

        return $player;
    }


    public function rules(): array
    {
        return [
            '*.player_id' => 'required|unique:players,player_id',
            '*.first_name' => 'required|string',
            '*.last_name' => 'required|string',
            '*.role' => 'required',
            '*.batting_style' => 'required',
            '*.bowling_style' => 'required',
        ];
    }
}

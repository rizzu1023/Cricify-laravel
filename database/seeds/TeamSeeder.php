<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('teams')->truncate();
        DB::table('teams')->insert([
            'team_code' => 'ENG',
            'team_name' => 'ENGLAND',
            'tournament_id' => 1,
            'user_id' => 2,
        ]);
        DB::table('teams')->insert([
            'team_code' => 'IND',
            'team_name' => 'INDIA',
            'tournament_id' => 1,
            'user_id' => 2,
        ]);
        DB::table('teams')->insert([
            'team_code' => 'AUS',
            'team_name' => 'AUSTRALIA',
            'tournament_id' => 1,
            'user_id' => 2,
        ]);
        DB::table('teams')->insert([
            'team_code' => 'NZ',
            'team_name' => 'NEW ZEALAND',
            'tournament_id' => 1,
            'user_id' => 2,
        ]);
        DB::table('teams')->insert([
            'team_code' => 'SA',
            'team_name' => 'SOUTH AFRICA',
            'tournament_id' => 1,
            'user_id' => 2,
        ]);
        DB::table('teams')->insert([
            'team_code' => 'WI',
            'team_name' => 'WEST INDIES',
            'tournament_id' => 1,
            'user_id' => 2,
        ]);
        DB::table('teams')->insert([
            'team_code' => 'PAK',
            'team_name' => 'PAKISTAN',
            'tournament_id' => 1,
            'user_id' => 2,
        ]);
        DB::table('teams')->insert([
            'team_code' => 'SL',
            'team_name' => 'SRI LANKA',
            'tournament_id' => 1,
            'user_id' => 2,
        ]);

    }
}

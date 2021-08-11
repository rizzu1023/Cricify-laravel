<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('tournaments')->truncate();
        DB::table('tournaments')->insert([
            'tournament_name' => 'CWC19',
            'start_date' => '2019-12-12',
            'end_date' => '2019-12-12',
            'user_id' => 2,
        ]);

        DB::table('tournaments')->insert([
            'tournament_name' => 'IPL19',
            'start_date' => '2019-12-12',
            'end_date' => '2019-12-12',
            'user_id' => 2,
        ]);
    }
}

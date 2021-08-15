<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterBattingStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_batting_styles')->truncate();
        DB::table('master_batting_styles')->insert([
            'id' => 1,
            'name' => 'Right Hand Batsman',
        ]);
        DB::table('master_batting_styles')->insert([
            'id' => 2,
            'name' => 'Left Hand Batsman',
        ]);
    }
}

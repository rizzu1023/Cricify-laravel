<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterBowlingStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_bowling_styles')->truncate();
        DB::table('master_bowling_styles')->insert([
            'id' => 1,
            'name' => 'Right Arm Faster',
        ]);
        DB::table('master_bowling_styles')->insert([
            'id' => 2,
            'name' => 'Right Arm Medium Faster',
        ]);
        DB::table('master_bowling_styles')->insert([
            'id' => 3,
            'name' => 'Left Arm Faster',
        ]);
        DB::table('master_bowling_styles')->insert([
            'id' => 4,
            'name' => 'Left Arm Medium Faster',
        ]);
        DB::table('master_bowling_styles')->insert([
            'id' => 5,
            'name' => 'Right Arm Spinner',
        ]);
        DB::table('master_bowling_styles')->insert([
            'id' => 6,
            'name' => 'Left Arm Spinner',
        ]);
    }
}

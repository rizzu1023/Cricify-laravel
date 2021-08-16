<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MasterRole;

class MasterRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterRole::truncate();
        MasterRole::create([
            'name' => 'Batsman',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterRole::create([
            'name' => 'Bowler',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterRole::create([
            'name' => 'WK-Batsman',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterRole::create([
            'name' => 'Batting AllRounder',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterRole::create([
            'name' => 'Bowling AllRounder',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

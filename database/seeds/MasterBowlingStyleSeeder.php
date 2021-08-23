<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MasterBowlingStyle;

class MasterBowlingStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterBowlingStyle::truncate();
        MasterBowlingStyle::create([
            'name' => 'Right Arm Fast',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterBowlingStyle::create([
            'name' => 'Right Arm Medium Fast',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterBowlingStyle::create([
            'name' => 'Left Arm Fast',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterBowlingStyle::create([
            'name' => 'Left Arm Medium Fast',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterBowlingStyle::create([
            'name' => 'Off Spinner',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterBowlingStyle::create([
            'name' => 'Leg Spinner',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\MasterBattingStyle;
use Carbon\Carbon;
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
        MasterBattingStyle::truncate();
        MasterBattingStyle::create([
            'name' => 'Right Hand Batsman',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        MasterBattingStyle::create([
            'name' => 'Left Hand Batsman',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_roles')->truncate();
        DB::table('master_roles')->insert([
            'id' => 1,
            'name' => 'Batsman',
        ]);
        DB::table('master_roles')->insert([
            'id' => 2,
            'name' => 'Bowler',
        ]);
        DB::table('master_roles')->insert([
            'id' => 3,
            'name' => 'All Rounder',
        ]);
        DB::table('master_roles')->insert([
            'id' => 4,
            'name' => 'Wicket Keeper',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Tournament::factory()->create();
//        \App\Teams::factory(10)->create();
//        \App\Players::factory(60)->create();

//        $this->call(\Database\Seeders\UserSeeder::class);
//        $this->call(\Database\Seeders\TournamentSeeder::class);
//        $this->call(\Database\Seeders\TeamSeeder::class);
        $this->call(\Database\Seeders\PlayerSeeder::class);
        $this->call(\Database\Seeders\PlayerTeamSeeder::class);
        $this->call(\Database\Seeders\ScheduleSeeder::class);

    }
}

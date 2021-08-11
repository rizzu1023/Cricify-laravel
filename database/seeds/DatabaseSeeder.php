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
        $this->call(\Database\Seeders\UserSeeder::class);
        $this->call(\Database\Seeders\TournamentSeeder::class);
        $this->call(\Database\Seeders\TeamSeeder::class);
        $this->call(\Database\Seeders\PlayerSeeder::class);
        $this->call(\Database\Seeders\PlayerTeamSeeder::class);
        $this->call(\Database\Seeders\ScheduleSeeder::class);

    }
}

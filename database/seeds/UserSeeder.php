<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'WANC STUDIOS',
            'email' => 'wancstudios@gmail.com',
            'password' => Hash::make('Wancstudios@ars21'),
            'email_verified_at' => Carbon::now(),
            'is_active' => 1,
            'is_super_admin' => 1,
            'user_type' => 'super-admin',
        ]);
        DB::table('users')->insert([
            'name' => 'Balapeer Premier League',
            'email' => 'bpl@gmail.com',
            'password' => Hash::make('bpl@2021'),
            'email_verified_at' => Carbon::now(),
            'is_active' => 1,
            'is_super_admin' => 0,
            'user_type' => 'super-admin',
        ]);
    }
}

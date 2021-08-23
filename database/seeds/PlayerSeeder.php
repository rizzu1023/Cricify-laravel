<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->truncate();
        DB::table('battings')->truncate();
        DB::table('bowlings')->truncate();
        DB::table('players')->insert([
            'player_id' => 1,
            'first_name' => 'Eoin',
            'last_name' => 'Morgan',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 1
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 1
        ]);


        DB::table('players')->insert([
            'player_id' => 2,

            'first_name' => 'Joe',
            'last_name' => 'Root',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 2
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 2
        ]);


        DB::table('players')->insert([
            'player_id' => 3,

            'first_name' => 'Jason',
            'last_name' => 'Roy',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 3
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 3
        ]);


        DB::table('players')->insert([
            'player_id' => 4,

            'first_name' => 'Liam',
            'last_name' => 'Livingstone',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 4
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 4
        ]);


        DB::table('players')->insert([
            'player_id' => 5,

            'first_name' => 'David',
            'last_name' => 'Malan',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 5
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 5
        ]);


        DB::table('players')->insert([
            'player_id' => 6,

            'first_name' => 'Moeen',
            'last_name' => 'Ali',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 6
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 6
        ]);


        DB::table('players')->insert([
            'player_id' => 7,

            'first_name' => 'Ben',
            'last_name' => 'Stokes',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 7
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 7
        ]);


        DB::table('players')->insert([
            'player_id' => 8,

            'first_name' => 'Chris',
            'last_name' => 'Woakes',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 8
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 8
        ]);



        DB::table('players')->insert([
            'player_id' => 9,

            'first_name' => 'Tom',
            'last_name' => 'Curran',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 9
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 9
        ]);


        DB::table('players')->insert([
            'player_id' => 10,

            'first_name' => 'Sam',
            'last_name' => 'Curran',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 10
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 10
        ]);


        DB::table('players')->insert([
            'player_id' => 11,

            'first_name' => 'Jonny',
            'last_name' => 'Bairstow',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 11
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 11
        ]);



        DB::table('players')->insert([
            'player_id' => 12,

            'first_name' => 'Jos',
            'last_name' => 'Buttler',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 12
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 12
        ]);


        //INDIA  13-24

        DB::table('players')->insert([
            'player_id' => 13,

            'first_name' => 'Virat',
            'last_name' => 'Kohli',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 13
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 13
        ]);


        DB::table('players')->insert([
            'player_id' => 14,

            'first_name' => 'Rohit',
            'last_name' => 'Sharma',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 14
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 14
        ]);


        DB::table('players')->insert([
            'player_id' => 15,

            'first_name' => 'Shikhar',
            'last_name' => 'Dhawan',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 15
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 15
        ]);


        DB::table('players')->insert([
            'player_id' => 16,

            'first_name' => 'Shubam',
            'last_name' => 'Gill',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 16
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 16
        ]);


        DB::table('players')->insert([
            'player_id' => 17,

            'first_name' => 'Ajinkya',
            'last_name' => 'Rahane',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 17
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 17
        ]);


        DB::table('players')->insert([
            'player_id' => 18,

            'first_name' => 'Hardik',
            'last_name' => 'Pandya',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 18
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 18
        ]);


        DB::table('players')->insert([
            'player_id' => 19,

            'first_name' => 'Ravindra',
            'last_name' => 'Jadeja',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 19
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 19
        ]);


        DB::table('players')->insert([
            'player_id' => 20,

            'first_name' => 'KL',
            'last_name' => 'Rahul',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 20
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 20
        ]);


        DB::table('players')->insert([
            'player_id' => 21,

            'first_name' => 'Rishab',
            'last_name' => 'Pant',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 21
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 21
        ]);


        DB::table('players')->insert([
            'player_id' => 22,

            'first_name' => 'Mohammed',
            'last_name' => 'Shami',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 22
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 22
        ]);


        DB::table('players')->insert([
            'player_id' => 23,

            'first_name' => 'Jasprit',
            'last_name' => 'Bumrah',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 23
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 23
        ]);


        DB::table('players')->insert([
            'player_id' => 24,

            'first_name' => 'Mohammed',
            'last_name' => 'Siraj',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 24
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 24
        ]);


        // AUSTRALIA  25-36

        DB::table('players')->insert([
            'player_id' => 25,

            'first_name' => 'Aaron',
            'last_name' => 'Finch',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 25
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 25
        ]);


        DB::table('players')->insert([
            'player_id' => 26,

            'first_name' => 'Steve',
            'last_name' => 'Smith',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 26
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 26
        ]);


        DB::table('players')->insert([
            'player_id' => 27,

            'first_name' => 'David',
            'last_name' => 'Warner',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 27
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 27
        ]);


        DB::table('players')->insert([
            'player_id' => 28,

            'first_name' => 'Joe',
            'last_name' => 'Burns',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 28
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 28
        ]);


        DB::table('players')->insert([
            'player_id' => 29,

            'first_name' => 'Will',
            'last_name' => 'Pocuvski',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 29
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 29
        ]);


        DB::table('players')->insert([
            'player_id' => 30,

            'first_name' => 'Glenn',
            'last_name' => 'Maxwell',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 30
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 30
        ]);


        DB::table('players')->insert([
            'player_id' => 31,

            'first_name' => 'Cameroon',
            'last_name' => 'Gareen',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 31
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 31
        ]);


        DB::table('players')->insert([
            'player_id' => 32,

            'first_name' => 'Alex',
            'last_name' => 'Carey',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 32
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 32
        ]);


        DB::table('players')->insert([
            'player_id' => 33,

            'first_name' => 'Tim',
            'last_name' => 'Paine',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 33
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 33
        ]);


        DB::table('players')->insert([
            'player_id' => 34,

            'first_name' => 'Pat',
            'last_name' => 'Cummins',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 34
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 34
        ]);


        DB::table('players')->insert([
            'player_id' => 35,

            'first_name' => 'Mitchell',
            'last_name' => 'Starc',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 35
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 35
        ]);


        DB::table('players')->insert([
            'player_id' => 36,

            'first_name' => 'Josh',
            'last_name' => 'Hazlewood',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 36
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 36
        ]);


        //New zealand 37-48

        DB::table('players')->insert([
            'player_id' => 37,

            'first_name' => 'Martin',
            'last_name' => 'Guptill',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 37
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 37
        ]);


        DB::table('players')->insert([
            'player_id' => 38,

            'first_name' => 'Ross',
            'last_name' => 'Taylor',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 38
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 38
        ]);


        DB::table('players')->insert([
            'player_id' => 39,

            'first_name' => 'Kane',
            'last_name' => 'Williomson',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 39
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 39
        ]);


        DB::table('players')->insert([
            'player_id' => 40,

            'first_name' => 'Henry ',
            'last_name' => 'Nicholas',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 40
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 40
        ]);


        DB::table('players')->insert([
            'player_id' => 41,

            'first_name' => 'James',
            'last_name' => 'Neesham',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 41
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 41
        ]);


        DB::table('players')->insert([
            'player_id' => 42,

            'first_name' => 'Colin',
            'last_name' => 'Munro',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 42
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 42
        ]);


        DB::table('players')->insert([
            'player_id' => 43,

            'first_name' => 'Mitchell',
            'last_name' => 'Santner',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 43
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 43
        ]);


        DB::table('players')->insert([
            'player_id' => 44,

            'first_name' => 'Tom',
            'last_name' => 'Latham',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 44
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 44
        ]);


        DB::table('players')->insert([
            'player_id' => 45,

            'first_name' => 'Tom',
            'last_name' => 'Blundell',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 45
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 45
        ]);


        DB::table('players')->insert([
            'player_id' => 46,

            'first_name' => 'Trent',
            'last_name' => 'Bolt',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 46
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 46
        ]);


        DB::table('players')->insert([
            'player_id' => 47,

            'first_name' => 'Mat',
            'last_name' => 'Henry',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 47
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 47
        ]);


        DB::table('players')->insert([
            'player_id' => 48,

            'first_name' => 'Tim',
            'last_name' => 'Southee',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 48
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 48
        ]);


        //South Africa 49-60

        DB::table('players')->insert([
            'player_id' => 49,

            'first_name' => 'FAF',
            'last_name' => 'Du Plessis',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 49
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 49
        ]);


        DB::table('players')->insert([
            'player_id' => 50,

            'first_name' => 'David',
            'last_name' => 'Miller',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 50
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 50
        ]);


        DB::table('players')->insert([
            'player_id' => 51,

            'first_name' => 'Aiden',
            'last_name' => 'Markram',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 51
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 51
        ]);


        DB::table('players')->insert([
            'player_id' => 52,

            'first_name' => 'Jean Paul',
            'last_name' => 'Duminy',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 52
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 52
        ]);


        DB::table('players')->insert([
            'player_id' => 53,

            'first_name' => 'Andile',
            'last_name' => 'Phehlukwayo',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 53
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 53
        ]);


        DB::table('players')->insert([
            'player_id' => 54,

            'first_name' => 'Chris',
            'last_name' => 'Morris',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 54
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 54
        ]);


        DB::table('players')->insert([
            'player_id' => 55,

            'first_name' => 'Dwaine',
            'last_name' => 'Pretorius',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 55
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 55
        ]);


        DB::table('players')->insert([
            'player_id' => 56,

            'first_name' => 'Quinton',
            'last_name' => 'de Kock',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 56
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 56
        ]);


        DB::table('players')->insert([
            'player_id' => 57,

            'first_name' => 'Kagiso',
            'last_name' => 'Rabada',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 57
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 57
        ]);


        DB::table('players')->insert([
            'player_id' => 58,

            'first_name' => 'Lungi',
            'last_name' => 'Ngidi',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 58
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 58
        ]);


        DB::table('players')->insert([
            'player_id' => 59,

            'first_name' => 'Tabraiz',
            'last_name' => 'Shamsi',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 59
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 59
        ]);


        DB::table('players')->insert([
            'player_id' => 60,

            'first_name' => 'Imran',
            'last_name' => 'Tahir',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 60
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 60
        ]);


        //WEST INDIES 61-72


        DB::table('players')->insert([
            'player_id' => 61,

            'first_name' => 'Daren',
            'last_name' => 'Bravo',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 61
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 61
        ]);


        DB::table('players')->insert([
            'player_id' => 62,

            'first_name' => 'Chris',
            'last_name' => 'Gayle',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 62
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 62
        ]);


        DB::table('players')->insert([
            'player_id' => 63,

            'first_name' => 'Evin',
            'last_name' => 'Lewis',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 63
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 63
        ]);


        DB::table('players')->insert([
            'player_id' => 64,

            'first_name' => 'Shimron',
            'last_name' => 'Hetmyer',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 64
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 64
        ]);


        DB::table('players')->insert([
            'player_id' => 65,

            'first_name' => 'Fabian',
            'last_name' => 'Allen',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 65
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 65
        ]);


        DB::table('players')->insert([
            'player_id' => 66,

            'first_name' => 'Json',
            'last_name' => 'Holder',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 66
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 66
        ]);


        DB::table('players')->insert([
            'player_id' => 67,

            'first_name' => 'Andre',
            'last_name' => 'Russell',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 67
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 67
        ]);


        DB::table('players')->insert([
            'player_id' => 68,

            'first_name' => 'Shai',
            'last_name' => 'Hope',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 68
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 68
        ]);


        DB::table('players')->insert([
            'player_id' => 69,

            'first_name' => 'Nicholas',
            'last_name' => 'Pooran',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 69
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 69
        ]);


        DB::table('players')->insert([
            'player_id' => 70,

            'first_name' => 'Sheldon',
            'last_name' => 'Cottrell',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 70
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 70
        ]);


        DB::table('players')->insert([
            'player_id' => 71,

            'first_name' => 'Shannon',
            'last_name' => 'Gabriel',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 71
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 71
        ]);


        DB::table('players')->insert([
            'player_id' => 72,

            'first_name' => 'Kemar',
            'last_name' => 'Roach',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 72
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 72
        ]);


        //PAKISTAN 73-84

        DB::table('players')->insert([
            'player_id' => 73,

            'first_name' => 'Fakhar',
            'last_name' => 'Zaman',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 73
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 73
        ]);


        DB::table('players')->insert([
            'player_id' => 74,

            'first_name' => 'Imam-ul',
            'last_name' => 'Haq',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 74
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 74
        ]);


        DB::table('players')->insert([
            'player_id' => 75,

            'first_name' => 'Babar',
            'last_name' => 'Azam',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 75
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 75
        ]);


        DB::table('players')->insert([
            'player_id' => 76,

            'first_name' => 'Asif',
            'last_name' => 'Ali',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 76
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 76
        ]);

        DB::table('players')->insert([
            'player_id' => 77,

            'first_name' => 'Haris',
            'last_name' => 'Sohail',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 77
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 77
        ]);


        DB::table('players')->insert([
            'player_id' => 78,

            'first_name' => 'Mohammed',
            'last_name' => 'Hafeez',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 78
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 78
        ]);


        DB::table('players')->insert([
            'player_id' => 79,

            'first_name' => 'Shoiab ',
            'last_name' => 'Malik',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 79
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 79
        ]);


        DB::table('players')->insert([
            'player_id' => 80,

            'first_name' => 'Mohammed',
            'last_name' => 'Rizwan',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 80
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 80
        ]);


        DB::table('players')->insert([
            'player_id' => 81,

            'first_name' => 'Sarfraz',
            'last_name' => 'Ahmed',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 81
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 81
        ]);


        DB::table('players')->insert([
            'player_id' => 82,

            'first_name' => 'Wahab',
            'last_name' => 'Riaz',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 82
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 82
        ]);



        DB::table('players')->insert([
            'player_id' => 83,

            'first_name' => 'Shahid',
            'last_name' => 'Afridi',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 83
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 83
        ]);


        DB::table('players')->insert([
            'player_id' => 84,

            'first_name' => 'Mohammed',
            'last_name' => 'Amir',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 84
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 84
        ]);



        //SRI LANKA
        DB::table('players')->insert([
            'player_id' => 85,

            'first_name' => 'Lahirr',
            'last_name' => 'Thrimanne',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 85
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 85
        ]);


        DB::table('players')->insert([
            'player_id' => 86,

            'first_name' => 'Dimuth',
            'last_name' => 'Karunaratne',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 86
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 86
        ]);



        DB::table('players')->insert([
            'player_id' => 87,

            'first_name' => 'Aviska',
            'last_name' => 'Fernando',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 87
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 87
        ]);


        DB::table('players')->insert([
            'player_id' => 88,

            'first_name' => 'Kusal',
            'last_name' => 'Mendis',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 88
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 88
        ]);



        DB::table('players')->insert([
            'player_id' => 89,

            'first_name' => 'Angelo',
            'last_name' => 'Mathews',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 89
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 89
        ]);


        DB::table('players')->insert([
            'player_id' => 90,

            'first_name' => 'Tisara',
            'last_name' => 'Perera',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 90
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 90
        ]);


        DB::table('players')->insert([
            'player_id' => 91,

            'first_name' => 'Isuru',
            'last_name' => 'Udana',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 91
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 91
        ]);


        DB::table('players')->insert([
            'player_id' => 92,

            'first_name' => 'Jeevan',
            'last_name' => 'Mendis',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 92
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 92
        ]);


        DB::table('players')->insert([
            'player_id' => 93,

            'first_name' => 'Kusal',
            'last_name' => 'Perera',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 93
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 93
        ]);


        DB::table('players')->insert([
            'player_id' => 94,

            'first_name' => 'Suranga',
            'last_name' => 'Lakmal',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 94
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 94
        ]);


        DB::table('players')->insert([
            'player_id' => 95,

            'first_name' => 'Lasith',
            'last_name' => 'Malinga',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 95
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 95
        ]);

        DB::table('players')->insert([
            'player_id' => 96,

            'first_name' => 'Nuwan',
            'last_name' => 'Pradeep',
            'role_id' => 1,
            'batting_style_id' => 1,
            'bowling_style_id' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('battings')->insert([
            'player_id' => 96
        ]);
        DB::table('bowlings')->insert([
            'player_id' => 96
        ]);


    }
}

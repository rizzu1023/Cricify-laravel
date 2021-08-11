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
//        DB::table('players')->truncate();
        DB::table('players')->insert([
            'player_id' => 'EM',

            'first_name' => 'Eoin',
            'last_name' => 'Morgan',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 'Right Arm Offbreak',
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JR',

            'first_name' => 'Joe',
            'last_name' => 'Root',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JRY',

            'first_name' => 'Jason',
            'last_name' => 'Roy',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'LL',

            'first_name' => 'Liam',
            'last_name' => 'Livingstone',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'DM',

            'first_name' => 'David',
            'last_name' => 'Malan',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'MAL',

            'first_name' => 'Moeen',
            'last_name' => 'Ali',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'BST',

            'first_name' => 'Ben',
            'last_name' => 'Stokes',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'CW',

            'first_name' => 'Chris',
            'last_name' => 'Woakes',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);


        DB::table('players')->insert([
            'player_id' => 'TCR',

            'first_name' => 'Tom',
            'last_name' => 'Curran',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'SMR',

            'first_name' => 'Sam',
            'last_name' => 'Curran',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JBW',

            'first_name' => 'Jonny',
            'last_name' => 'Bairstow',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JBT',

            'first_name' => 'Jos',
            'last_name' => 'Buttler',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        //INDIA  13-24

        DB::table('players')->insert([
            'player_id' => 'VK',

            'first_name' => 'Virat',
            'last_name' => 'Kohli',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'RHS',

            'first_name' => 'Rohit',
            'last_name' => 'Sharma',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'SDW',

            'first_name' => 'Shikhar',
            'last_name' => 'Dhawan',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'SGL',

            'first_name' => 'Shubam',
            'last_name' => 'Gill',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'ARH',

            'first_name' => 'Ajinkya',
            'last_name' => 'Rahane',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'HPD',

            'first_name' => 'Hardik',
            'last_name' => 'Pandya',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'RJD',

            'first_name' => 'Ravindra',
            'last_name' => 'Jadeja',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'KLR',

            'first_name' => 'KL',
            'last_name' => 'Rahul',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'RPT',

            'first_name' => 'Rishab',
            'last_name' => 'Pant',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'MSM',

            'first_name' => 'Mohammed',
            'last_name' => 'Shami',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JBM',

            'first_name' => 'Jasprit',
            'last_name' => 'Bumrah',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'MSJ',

            'first_name' => 'Mohammed',
            'last_name' => 'Siraj',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        // AUSTRALIA  25-36

        DB::table('players')->insert([
            'player_id' => 'AFC',

            'first_name' => 'Aaron',
            'last_name' => 'Finch',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'SSM',

            'first_name' => 'Steve',
            'last_name' => 'Smith',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'DWR',

            'first_name' => 'David',
            'last_name' => 'Warner',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JOB',

            'first_name' => 'Joe',
            'last_name' => 'Burns',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'WPC',

            'first_name' => 'Will',
            'last_name' => 'Pocuvski',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'GMX',

            'first_name' => 'Glenn',
            'last_name' => 'Maxwell',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'CGN',

            'first_name' => 'Cameroon',
            'last_name' => 'Gareen',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'AXC',

            'first_name' => 'Alex',
            'last_name' => 'Carey',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'TPN',

            'first_name' => 'Tim',
            'last_name' => 'Paine',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'PCM',

            'first_name' => 'Pat',
            'last_name' => 'Cummins',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'MST',

            'first_name' => 'Mitchell',
            'last_name' => 'Starc',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JSH',

            'first_name' => 'Josh',
            'last_name' => 'Hazlewood',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        //New zealand 37-48

        DB::table('players')->insert([
            'player_id' => 'MGT',

            'first_name' => 'Martin',
            'last_name' => 'Guptill',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'RTY',

            'first_name' => 'Ross',
            'last_name' => 'Taylor',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'KWL',

            'first_name' => 'Kane',
            'last_name' => 'Williomson',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'HNC',

            'first_name' => 'Henry ',
            'last_name' => 'Nicholas',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JNS',

            'first_name' => 'James',
            'last_name' => 'Neesham',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'CMN',

            'first_name' => 'Colin',
            'last_name' => 'Munro',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'MSN',

            'first_name' => 'Mitchell',
            'last_name' => 'Santner',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'TLM',

            'first_name' => 'Tom',
            'last_name' => 'Latham',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'TBL',

            'first_name' => 'Tom',
            'last_name' => 'Blundell',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'TBT',

            'first_name' => 'Trent',
            'last_name' => 'Bolt',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'MHR',

            'first_name' => 'Mat',
            'last_name' => 'Henry',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'TMS',

            'first_name' => 'Tim',
            'last_name' => 'Southee',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        //South Africa 49-60

        DB::table('players')->insert([
            'player_id' => 'FAF',

            'first_name' => 'Faf',
            'last_name' => 'Du Plessis',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'DMR',

            'first_name' => 'David',
            'last_name' => 'Miller',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'AMR',

            'first_name' => 'Aiden',
            'last_name' => 'Markram',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JPD',

            'first_name' => 'Jean Paul',
            'last_name' => 'Duminy',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'APW',

            'first_name' => 'Andile',
            'last_name' => 'Phehlukwayo',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'CMR',

            'first_name' => 'Chris',
            'last_name' => 'Morris',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'DPT',

            'first_name' => 'Dwaine',
            'last_name' => 'Pretorius',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'QDK',

            'first_name' => 'Quinton',
            'last_name' => 'de Kock',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'KRB',

            'first_name' => 'Kagiso',
            'last_name' => 'Rabada',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'LNG',

            'first_name' => 'Lungi',
            'last_name' => 'Ngidi',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'TSM',

            'first_name' => 'Tabraiz',
            'last_name' => 'Shamsi',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'ITH',

            'first_name' => 'Imran',
            'last_name' => 'Tahir',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        //WEST INDIES 61-72


        DB::table('players')->insert([
            'player_id' => 'DBR',

            'first_name' => 'Daren',
            'last_name' => 'Bravo',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'CGY',

            'first_name' => 'Chris',
            'last_name' => 'Gayle',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'ELW',

            'first_name' => 'Evin',
            'last_name' => 'Lewis',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'SHT',

            'first_name' => 'Shimron',
            'last_name' => 'Hetmyer',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'FAN',

            'first_name' => 'Fabian',
            'last_name' => 'Allen',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JHD',

            'first_name' => 'Json',
            'last_name' => 'Holder',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'ARS',

            'first_name' => 'Andre',
            'last_name' => 'Russell',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'SHP',

            'first_name' => 'Shai',
            'last_name' => 'Hope',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'NPR',

            'first_name' => 'Nicholas',
            'last_name' => 'Pooran',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'SCR',

            'first_name' => 'Sheldon',
            'last_name' => 'Cottrell',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'SGB',

            'first_name' => 'Shannon',
            'last_name' => 'Gabriel',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'KMR',

            'first_name' => 'Kemar',
            'last_name' => 'Roach',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        //PAKISTAN 73-84

        DB::table('players')->insert([
            'player_id' => 'FZN',

            'first_name' => 'Fakhar',
            'last_name' => 'Zaman',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'IHQ',

            'first_name' => 'Imam-ul',
            'last_name' => 'Haq',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'BAM',

            'first_name' => 'Babar',
            'last_name' => 'Azam',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'ASA',

            'first_name' => 'Asif',
            'last_name' => 'Ali',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('players')->insert([
            'player_id' => 'HSH',

            'first_name' => 'Haris',
            'last_name' => 'Sohail',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'MHF',

            'first_name' => 'Mohammed',
            'last_name' => 'Hafeez',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('players')->insert([
            'player_id' => 'SBM',

            'first_name' => 'Shoiab ',
            'last_name' => 'Malik',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'MRZ',

            'first_name' => 'Mohammed',
            'last_name' => 'Rizwan',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('players')->insert([
            'player_id' => 'SRA',

            'first_name' => 'Sarfraz',
            'last_name' => 'Ahmed',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'WRZ',

            'first_name' => 'Wahab',
            'last_name' => 'Riaz',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);
        DB::table('players')->insert([
            'player_id' => 'SFD',

            'first_name' => 'Shahid',
            'last_name' => 'Afridi',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'MAR',

            'first_name' => 'Mohammed',
            'last_name' => 'Amir',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);


        //SRI LANKA
        DB::table('players')->insert([
            'player_id' => 'LTM',

            'first_name' => 'Lahirr',
            'last_name' => 'Thrimanne',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'DKR',

            'first_name' => 'Dimuth',
            'last_name' => 'Karunaratne',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);


        DB::table('players')->insert([
            'player_id' => 'AFN',

            'first_name' => 'Aviska',
            'last_name' => 'Fernando',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'KMN',

            'first_name' => 'Kusal',
            'last_name' => 'Mendis',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);


        DB::table('players')->insert([
            'player_id' => 'AGM',

            'first_name' => 'Angelo',
            'last_name' => 'Mathews',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'TSR',

            'first_name' => 'Tisara',
            'last_name' => 'Perera',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'IUD',

            'first_name' => 'Isuru',
            'last_name' => 'Udana',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'JMN',

            'first_name' => 'Jeevan',
            'last_name' => 'Mendis',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'KPR',

            'first_name' => 'Kusal',
            'last_name' => 'Perera',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'SLK',

            'first_name' => 'Suranga',
            'last_name' => 'Lakmal',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'LMG',

            'first_name' => 'Lasith',
            'last_name' => 'Malinga',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);

        DB::table('players')->insert([
            'player_id' => 'NPD',

            'first_name' => 'Nuwan',
            'last_name' => 'Pradeep',
            'role' => 1,
            'batting_style' => 1,
            'bowling_style' => 1,
            'dob' => '2000-12-12',
            'user_id' => 2,
        ]);


    }
}

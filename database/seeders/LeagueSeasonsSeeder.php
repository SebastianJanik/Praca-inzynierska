<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeagueSeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('league_season')->insert(
            [
                'id' => '1',
                'season_id' => '1',
                'league_id' => '1',
                'status_id' => '12'
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '2',
                'season_id' => '1',
                'league_id' => '2',
                'status_id' => '12'
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '3',
                'season_id' => '1',
                'league_id' => null,
                'status_id' => '12'
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '4',
                'season_id' => '2',
                'league_id' => '1',
                'status_id' => '12'
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '5',
                'season_id' => '2',
                'league_id' => '2',
                'status_id' => '12'
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '6',
                'season_id' => '2',
                'league_id' => null,
                'status_id' => '12'
            ]
        );
    }
}

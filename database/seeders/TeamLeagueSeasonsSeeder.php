<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamLeagueSeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team_league_seasons')->insert(
            [
                'team_id' => '1',
                'league_season_id' => '1'
            ]
        );
        DB::table('team_league_seasons')->insert(
            [
                'team_id' => '1',
                'league_season_id' => '4'
            ]
        );
        DB::table('team_league_seasons')->insert(
            [
                'team_id' => '2',
                'league_season_id' => '3'
            ]
        );
        DB::table('team_league_seasons')->insert(
            [
                'team_id' => '2',
                'league_season_id' => '4'
            ]
        );
        for($i= 4; $i<10; $i++){
            DB::table('team_league_seasons')->insert(
                [
                    'team_id' => $i,
                    'league_season_id' => '1'
                ]
            );
        }
    }
}

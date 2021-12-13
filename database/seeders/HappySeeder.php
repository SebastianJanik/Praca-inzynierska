<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HappySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seasons();
        $this->leagues();
        $this->league_season();
        $this->teams();
        $this->league_season_team();
        $this->admin();
        $this->players();
        $this->coaches();
        $this->users();
        $this->referees();
        $this->rounds();
        $this->matches();
    }

    public function seasons()
    {
        DB::table('seasons')->insert(
            [
                'id' => 1,
                'status_id' => 2,
                'name' => 'Pierwszy sezon',
                'created_at' => date('Y:m:d H:m:s'),
                'updated_at' => date('Y:m:d H:m:s')
            ]
        );
    }

    public function leagues()
    {
        DB::table('leagues')->insert(
            [
                'id' => 1,
                'name' => 'Pierwsza liga',
                'created_at' => date('Y:m:d H:m:s'),
                'updated_at' => date('Y:m:d H:m:s')
            ]
        );
        DB::table('leagues')->insert(
            [
                'id' => 2,
                'name' => 'Druga liga',
                'created_at' => date('Y:m:d H:m:s'),
                'updated_at' => date('Y:m:d H:m:s')
            ]
        );
    }

    public function league_season()
    {
        DB::table('league_season')->insert(
            [
                'season_id' => 1,
                'league_id' => 1,
                'status_id' => 11,
                'created_at' => date('Y:m:d H:m:s'),
                'updated_at' => date('Y:m:d H:m:s')
            ]
        );
        DB::table('league_season')->insert(
            [
                'season_id' => 1,
                'league_id' => 2,
                'status_id' => 11,
                'created_at' => date('Y:m:d H:m:s'),
                'updated_at' => date('Y:m:d H:m:s')
            ]
        );
        DB::table('league_season')->insert(
            [
                'season_id' => 1,
                'status_id' => 12,
                'created_at' => date('Y:m:d H:m:s'),
                'updated_at' => date('Y:m:d H:m:s')
            ]
        );
    }

    public function teams()
    {
        for($i= 1; $i<=7; $i++){
            DB::table('teams')->insert(
                [
                    'id' => $i,
                    'status_id' => '1',
                    'name' => $i. 'Druzyna',
                    'street' => $i.'ulica',
                    'house_number'=>'10',
                    'postal_code'=>'11-111',
                    'town'=> 'Miasto'.$i,
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s')
                ]
            );
        }
    }

    public function league_season_team()
    {
        for($i= 1; $i<=4; $i++) {
            DB::table('league_season_team')->insert(
                [
                    'team_id' => $i,
                    'league_season_id' => 1,
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
        }
        for($i= 5; $i<=7; $i++) {
            DB::table('league_season_team')->insert(
                [
                    'team_id' => $i,
                    'league_season_id' => 2,
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
        }
    }

    public function admin()
    {
        DB::table('users')->insert(
            [
                'id' => '1',
                'name' => 'Admin',
                'surname' => 'Admin',
                'date_birth' => '2000-01-01',
                'street' => 'street',
                'house_number' => '20',
                'postal_code' => '11-111',
                'town' => 'town',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'created_at' => date('Y:m:d H:m:s'),
                'updated_at' => date('Y:m:d H:m:s')
            ]
        );
    }
    public function players()
    {
        $team_id = 0;
        for ($i = 2; $i <= 28; ) {
            $team_id ++;
            for ($j = 1; $j <= 4; $j++) {
                DB::table('users')->insert(
                    [
                        'id' => $i,
                        'status_id' => 13,
                        'name' => 'User' . $i,
                        'surname' => 'User' . $i,
                        'date_birth' => '2000-01-01',
                        'street' => 'street',
                        'house_number' => '20',
                        'postal_code' => '11-111',
                        'town' => 'town',
                        'email' => 'user' . $i . '@user.com',
                        'password' => Hash::make('admin123'),
                        'created_at' => date('Y:m:d H:m:s'),
                        'updated_at' => date('Y:m:d H:m:s')
                    ]
                );

                DB::table('model_has_roles')->insert(
                    [
                        'role_id' => '2',
                        'model_type' => 'App\Models\User',
                        'model_id' => $i,
                    ]
                );
                DB::table('team_user')->insert(
                    [
                        'team_id' => $team_id,
                        'user_id' => $i,
                        'status_id' => 9,
                        'join_date' => date('Y:m:d H:m:s'),
                        'created_at' => date('Y:m:d H:m:s'),
                        'updated_at' => date('Y:m:d H:m:s'),
                    ]
                );
                $i++;
            }
        }
    }

    public function coaches()
    {
        $team_id = 1;
        for($i = 29; $i <= 35; $i ++)
        {
            DB::table('users')->insert(
                [
                    'id' => $i,
                    'status_id' => 13,
                    'name' => 'Coach' . $team_id,
                    'surname' => 'Coach' . $team_id,
                    'date_birth' => '2000-01-01',
                    'street' => 'street',
                    'house_number' => '20',
                    'postal_code' => '11-111',
                    'town' => 'town',
                    'email' => 'coach' . $team_id . '@coach.com',
                    'password' => Hash::make('admin123'),
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s')
                ]
            );

            DB::table('model_has_roles')->insert(
                [
                    'role_id' => '3',
                    'model_type' => 'App\Models\User',
                    'model_id' => $i,
                ]
            );
            DB::table('team_user')->insert(
                [
                    'team_id' => $team_id,
                    'user_id' => $i,
                    'status_id' => 9,
                    'join_date' => date('Y:m:d H:m:s'),
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
        }
    }

    public function users()
    {
        for ($i = 36; $i <=37; $i++)
        {
            DB::table('users')->insert(
                [
                    'id' => $i,
                    'status_id' => 1,
                    'name' => 'User' . $i,
                    'surname' => 'User' . $i,
                    'date_birth' => '2000-01-01',
                    'street' => 'street',
                    'house_number' => '20',
                    'postal_code' => '11-111',
                    'town' => 'town',
                    'email' => 'user' . $i . '@user' . $i . '.com',
                    'password' => Hash::make('admin123'),
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s')
                ]
            );

            DB::table('model_has_roles')->insert(
                [
                    'role_id' => '5',
                    'model_type' => 'App\Models\User',
                    'model_id' => $i,
                ]
            );
        }
    }

    public function referees()
    {
        for ($i = 38; $i <=39; $i++)
        {
            DB::table('users')->insert(
                [
                    'id' => $i,
                    'status_id' => 1,
                    'name' => 'Referee' . $i,
                    'surname' => 'Referee' . $i,
                    'date_birth' => '2000-01-01',
                    'street' => 'street',
                    'house_number' => '20',
                    'postal_code' => '11-111',
                    'town' => 'town',
                    'email' => 'referee' . $i . '@referee.com',
                    'password' => Hash::make('admin123'),
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s')
                ]
            );

            DB::table('model_has_roles')->insert(
                [
                    'role_id' => '4',
                    'model_type' => 'App\Models\User',
                    'model_id' => $i,
                ]
            );
        }
    }

    public function rounds()
    {
        for($i = 1; $i <= 6; $i++)
        {
            DB::table('rounds')->insert(
                [
                    'id' => $i,
                    'league_season_id' => 1,
                    'name' => $i,
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            DB::table('rounds')->insert(
                [
                    'id' => $i+6,
                    'league_season_id' => 1,
                    'name' => $i,
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
        }
    }

    public function matches()
    {
        $match_id = 1;
        for($i = 1; $i <= 6; $i++)
        {
            DB::table('matches')->insert(
                [
                    'id' => $match_id,
                    'round_id' => $i,
                    'status_id' => 16,
                    'date' => '2021-12-13',
                    'town' => 'town',
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            DB::table('matches')->insert(
                [
                    'id' => $match_id++,
                    'round_id' => $i,
                    'status_id' => 16,
                    'date' => '2021-12-13',
                    'town' => 'town',
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            DB::table('matches')->insert(
                [
                    'id' => $match_id + 12,
                    'round_id' => $i + 6,
                    'status_id' => 16,
                    'date' => '2021-12-13',
                    'town' => 'town',
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            DB::table('matches')->insert(
                [
                    'id' => ($match_id++) + 12,
                    'round_id' => $i + 6,
                    'status_id' => 16,
                    'date' => '2021-12-13',
                    'town' => 'town',
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
        }
    }
}

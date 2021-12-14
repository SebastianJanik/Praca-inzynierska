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
        $this->match_team_league1();
        $this->match_team_league2();
        $this->match_user_league1_team1();
        $this->match_user_league1_team2();
        $this->match_user_league1_team3();
        $this->match_user_league1_team4();
        $this->match_user_league1_team5();
        $this->match_user_league1_team6();
        $this->match_user_league1_team7();
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
        DB::table('model_has_roles')->insert(
            [
                'role_id' => '1',
                'model_type' => 'App\Models\User',
                'model_id' => '1',
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
                        'name' => 'Player' . $i,
                        'surname' => 'Player' . $i,
                        'date_birth' => '2000-01-01',
                        'street' => 'street',
                        'house_number' => '20',
                        'postal_code' => '11-111',
                        'town' => 'town',
                        'email' => 'player' . $i . '@player.com',
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
        for($i = 30; $i <= 36; $i ++)
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
            $team_id++;
        }
    }

    public function users()
    {
        $user = 1;
        for ($i = 37; $i <=38; $i++)
        {
            DB::table('users')->insert(
                [
                    'id' => $i,
                    'status_id' => 1,
                    'name' => 'User' . $user,
                    'surname' => 'User' . $user,
                    'date_birth' => '2000-01-01',
                    'street' => 'street',
                    'house_number' => '20',
                    'postal_code' => '11-111',
                    'town' => 'town',
                    'email' => 'user' . $user . '@user' . $user . '.com',
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
            $user++;
        }
    }

    public function referees()
    {
        $referee = 1;
        for ($i = 39; $i <=40; $i++)
        {
            DB::table('users')->insert(
                [
                    'id' => $i,
                    'status_id' => 1,
                    'name' => 'Referee' . $referee,
                    'surname' => 'Referee' . $referee,
                    'date_birth' => '2000-01-01',
                    'street' => 'street',
                    'house_number' => '20',
                    'postal_code' => '11-111',
                    'town' => 'town',
                    'email' => 'referee' . $referee . '@referee.com',
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
            $referee++;
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
                    'league_season_id' => 2,
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
        for($i = 1; $i <= 12; $i++)
        {
            DB::table('matches')->insert(
                [
                    'id' => $match_id,
                    'round_id' => $i,
                    'status_id' => 9,
                    'date' => '2021-12-13',
                    'town' => 'town',
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            $match_id++;
            DB::table('matches')->insert(
                [
                    'id' => $match_id,
                    'round_id' => $i,
                    'status_id' => 9,
                    'date' => '2021-12-13',
                    'town' => 'town',
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            $match_id++;
        }
    }

    public function match_team_league1()
    {
        $match_id = 1;
        $goals = array(2,0,1,1,3,3,0,1,2,1,2,3,2,2,1,3,1,1,2,1,0,1,0,0);
        $team_ids = array(1,2,3,4,2,3,4,1,1,3,4,2,2,1,4,3,3,2,1,4,3,1,2,4);
        for ($id = 1; $id <= 24;) {
            DB::table('match_team')->insert(
                [
                    'id' => $id,
                    'match_id' => $match_id,
                    'team_id' => $team_ids[$id - 1],
                    'goals' => $goals[$id - 1],
                    'host' => 1,
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            $id++;
            DB::table('match_team')->insert(
                [
                    'id' => $id,
                    'match_id' => $match_id++,
                    'team_id' => $team_ids[$id - 1],
                    'goals' => $goals[$id - 1],
                    'host' => 0,
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            $id++;
        }
    }
    public function match_team_league2()
    {
        $match_id = 13;
        $goals = array(2,0,null,null,3,3,null,null,2,1,null,null,2,2,null,null,1,1,null,null,0,1,null,null);
        $team_ids = array(5,6,7,null,6,7,null,5,5,7,null,6,6,5,null,7,7,6,5,null,7,5,6,null);
        for ($id = 1; $id <= 24;) {
            DB::table('match_team')->insert(
                [
                    'id' => $id + 24,
                    'match_id' => $match_id,
                    'team_id' => $team_ids[$id - 1],
                    'goals' => $goals[$id - 1],
                    'host' => 1,
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            $id++;
            DB::table('match_team')->insert(
                [
                    'id' => $id + 24,
                    'match_id' => $match_id++,
                    'team_id' => $team_ids[$id - 1],
                    'goals' => $goals[$id - 1],
                    'host' => 0,
                    'created_at' => date('Y:m:d H:m:s'),
                    'updated_at' => date('Y:m:d H:m:s'),
                ]
            );
            $id++;
        }
    }

    public function match_user_league1_team1()
    {
        $users = array(2,3,4,5,30);
        $matches = array(1,4,5,7,10,11);
        $yellow_cards = array(
            0 => array(1,1,1,1,0),
            1 => array(0,0,1,0,0),
            2 => array(0,1,1,0,0),
            3 => array(1,1,0,0,0),
            4 => array(1,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $red_cards = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $goals = array(
            0 => array(1,1,0,0,0),
            1 => array(0,0,0,1,0),
            2 => array(0,0,1,1,0),
            3 => array(0,0,2,0,0),
            4 => array(1,0,1,0,0),
            5 => array(0,1,0,0,0),
        );
        $assists = array(
            0 => array(0,1,1,0,0),
            1 => array(0,0,1,0,0),
            2 => array(0,2,0,0,0),
            3 => array(1,1,0,0,0),
            4 => array(0,1,1,0,0),
            5 => array(0,0,1,0,0),
        );
        $start_min = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $end_min = array(
            0 => array(90,90,90,90,0),
            1 => array(90,90,90,90,0),
            2 => array(90,90,80,90,0),
            3 => array(90,90,90,90,0),
            4 => array(90,70,90,90,0),
            5 => array(90,90,90,60,0),
        );
        foreach($matches as $index=>$match){
            foreach ($users as $key=>$user) {
                DB::table('match_user')->insert(
                    [
                        'match_id' => $match,
                        'user_id' => $user,
                        'yellow_card' => $yellow_cards[$index][$key],
                        'red_card' => $red_cards[$index][$key],
                        'goals' => $goals[$index][$key],
                        'assists' => $assists[$index][$key],
                        'start_min' => $start_min[$index][$key],
                        'end_min' => $end_min[$index][$key],
                        'created_at' => date('Y:m:d H:m:s'),
                        'updated_at' => date('Y:m:d H:m:s'),
                    ]
                );
            }
        }
    }
    public function match_user_league1_team2()
    {
        $users = array(6,7,8,9,31);
        $matches = array(1,3,6,7,9,12);
        $yellow_cards = array(
            0 => array(0,1,1,1,0),
            1 => array(1,0,1,0,0),
            2 => array(0,1,1,0,0),
            3 => array(1,1,0,1,0),
            4 => array(1,0,0,1,0),
            5 => array(0,0,1,0,0),
        );
        $red_cards = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $goals = array(
            0 => array(0,0,0,0,0),
            1 => array(1,1,0,1,0),
            2 => array(0,1,1,1,0),
            3 => array(0,0,2,0,0),
            4 => array(1,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $assists = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,1,2,0),
            2 => array(1,2,0,0,0),
            3 => array(1,1,0,0,0),
            4 => array(0,1,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $start_min = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $end_min = array(
            0 => array(90,90,90,90,0),
            1 => array(90,90,90,90,0),
            2 => array(90,90,80,90,0),
            3 => array(90,90,90,90,0),
            4 => array(90,70,90,90,0),
            5 => array(90,90,90,60,0),
        );
        foreach($matches as $index=>$match){
            foreach ($users as $key=>$user) {
                DB::table('match_user')->insert(
                    [
                        'match_id' => $match,
                        'user_id' => $user,
                        'yellow_card' => $yellow_cards[$index][$key],
                        'red_card' => $red_cards[$index][$key],
                        'goals' => $goals[$index][$key],
                        'assists' => $assists[$index][$key],
                        'start_min' => $start_min[$index][$key],
                        'end_min' => $end_min[$index][$key],
                        'created_at' => date('Y:m:d H:m:s'),
                        'updated_at' => date('Y:m:d H:m:s'),
                    ]
                );
            }
        }
    }

    public function match_user_league1_team3()
    {
        $users = array(10,11,12,13,32);
        $matches = array(2,3,5,8,9,11);
        $yellow_cards = array(
            0 => array(1,0,0,1,0),
            1 => array(0,1,1,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,1,0,0,0),
            4 => array(0,1,1,0,0),
            5 => array(1,1,1,0,0),
        );
        $red_cards = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $goals = array(
            0 => array(1,0,0,0,0),
            1 => array(1,2,0,0,0),
            2 => array(0,1,0,0,0),
            3 => array(0,2,1,0,0),
            4 => array(0,1,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $assists = array(
            0 => array(0,0,1,0,0),
            1 => array(0,1,1,1,0),
            2 => array(1,0,0,0,0),
            3 => array(1,1,1,0,0),
            4 => array(0,0,1,0,0),
            5 => array(0,0,0,0,0),
        );
        $start_min = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $end_min = array(
            0 => array(90,90,90,90,0),
            1 => array(90,90,90,90,0),
            2 => array(90,90,80,90,0),
            3 => array(90,90,90,90,0),
            4 => array(90,70,90,90,0),
            5 => array(90,90,90,60,0),
        );
        foreach($matches as $index=>$match){
            foreach ($users as $key=>$user) {
                DB::table('match_user')->insert(
                    [
                        'match_id' => $match,
                        'user_id' => $user,
                        'yellow_card' => $yellow_cards[$index][$key],
                        'red_card' => $red_cards[$index][$key],
                        'goals' => $goals[$index][$key],
                        'assists' => $assists[$index][$key],
                        'start_min' => $start_min[$index][$key],
                        'end_min' => $end_min[$index][$key],
                        'created_at' => date('Y:m:d H:m:s'),
                        'updated_at' => date('Y:m:d H:m:s'),
                    ]
                );
            }
        }
    }
    public function match_user_league1_team4()
    {
        $users = array(14,15,16,17,33);
        $matches = array(2,4,6,8,10,12);
        $yellow_cards = array(
            0 => array(0,0,1,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,1,1,0,0),
            3 => array(0,1,0,0,0),
            4 => array(0,0,0,1,0),
            5 => array(0,0,0,0,0),
        );
        $red_cards = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $goals = array(
            0 => array(0,1,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,1,1,0,0),
            3 => array(0,0,1,0,0),
            4 => array(0,0,1,0,0),
            5 => array(0,0,0,0,0),
        );
        $assists = array(
            0 => array(0,0,0,1,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,2,0),
            3 => array(0,0,0,1,0),
            4 => array(0,0,0,1,0),
            5 => array(0,0,0,0,0),
        );
        $start_min = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $end_min = array(
            0 => array(90,90,90,90,0),
            1 => array(90,90,90,90,0),
            2 => array(90,90,80,90,0),
            3 => array(90,90,90,90,0),
            4 => array(90,70,90,90,0),
            5 => array(90,90,90,60,0),
        );
        foreach($matches as $index=>$match){
            foreach ($users as $key=>$user) {
                DB::table('match_user')->insert(
                    [
                        'match_id' => $match,
                        'user_id' => $user,
                        'yellow_card' => $yellow_cards[$index][$key],
                        'red_card' => $red_cards[$index][$key],
                        'goals' => $goals[$index][$key],
                        'assists' => $assists[$index][$key],
                        'start_min' => $start_min[$index][$key],
                        'end_min' => $end_min[$index][$key],
                        'created_at' => date('Y:m:d H:m:s'),
                        'updated_at' => date('Y:m:d H:m:s'),
                    ]
                );
            }
        }
    }
    public function match_user_league1_team5()
    {
        $users = array(18,19,20,21,34);
        $matches = array(13,16,17,19,22,23);
        $yellow_cards = array(
            0 => array(0,1,0,1,0),
            1 => array(0,0,0,0,0),
            2 => array(0,1,1,0,0),
            3 => array(0,1,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,1,0,0,0),
        );
        $red_cards = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $goals = array(
            0 => array(1,0,1,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,1,1,0,0),
            3 => array(0,0,2,0,0),
            4 => array(0,0,0,0,0),
            5 => array(1,0,0,0,0),
        );
        $assists = array(
            0 => array(0,2,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,1,1,0),
            3 => array(1,1,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,1,0,0),
        );
        $start_min = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $end_min = array(
            0 => array(90,90,90,90,0),
            1 => array(0,0,0,0,0),
            2 => array(90,90,80,90,0),
            3 => array(90,90,90,90,0),
            4 => array(0,0,0,0,0),
            5 => array(90,90,90,60,0),
        );
        foreach($matches as $index=>$match){
            foreach ($users as $key=>$user) {
                DB::table('match_user')->insert(
                    [
                        'match_id' => $match,
                        'user_id' => $user,
                        'yellow_card' => $yellow_cards[$index][$key],
                        'red_card' => $red_cards[$index][$key],
                        'goals' => $goals[$index][$key],
                        'assists' => $assists[$index][$key],
                        'start_min' => $start_min[$index][$key],
                        'end_min' => $end_min[$index][$key],
                        'created_at' => date('Y:m:d H:m:s'),
                        'updated_at' => date('Y:m:d H:m:s'),
                    ]
                );
            }
        }
    }
    public function match_user_league1_team6()
    {
        $users = array(22,23,24,25,35);
        $matches = array(13,15,18,19,21,24);
        $yellow_cards = array(
            0 => array(0,0,0,0,0),
            1 => array(0,1,1,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,1,1,0,0),
            4 => array(0,1,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $red_cards = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $goals = array(
            0 => array(0,0,0,0,0),
            1 => array(0,3,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,2,0,0,0),
            4 => array(0,1,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $assists = array(
            0 => array(0,0,0,0,0),
            1 => array(1,0,1,1,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,1,1,0),
            4 => array(0,0,1,0,0),
            5 => array(0,0,0,0,0),
        );
        $start_min = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $end_min = array(
            0 => array(90,90,90,90,0),
            1 => array(90,90,90,90,0),
            2 => array(0,0,0,0,0),
            3 => array(90,90,90,90,0),
            4 => array(90,70,90,90,0),
            5 => array(0,0,0,0,0),
        );
        foreach($matches as $index=>$match){
            foreach ($users as $key=>$user) {
                DB::table('match_user')->insert(
                    [
                        'match_id' => $match,
                        'user_id' => $user,
                        'yellow_card' => $yellow_cards[$index][$key],
                        'red_card' => $red_cards[$index][$key],
                        'goals' => $goals[$index][$key],
                        'assists' => $assists[$index][$key],
                        'start_min' => $start_min[$index][$key],
                        'end_min' => $end_min[$index][$key],
                        'created_at' => date('Y:m:d H:m:s'),
                        'updated_at' => date('Y:m:d H:m:s'),
                    ]
                );
            }
        }
    }
    public function match_user_league1_team7()
    {
        $users = array(26,27,28,29,36);
        $matches = array(14,15,17,20,21,23);
        $yellow_cards = array(
            0 => array(0,0,0,0,0),
            1 => array(1,1,0,0,0),
            2 => array(0,0,1,1,0),
            3 => array(0,0,0,0,0),
            4 => array(0,1,0,0,0),
            5 => array(0,0,1,0,0),
        );
        $red_cards = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $goals = array(
            0 => array(0,0,0,0,0),
            1 => array(0,2,1,0,0),
            2 => array(0,1,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,1,0,0),
            5 => array(0,0,0,0,0),
        );
        $assists = array(
            0 => array(0,0,0,0,0),
            1 => array(1,1,0,0,0),
            2 => array(0,0,1,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,1,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $start_min = array(
            0 => array(0,0,0,0,0),
            1 => array(0,0,0,0,0),
            2 => array(0,0,0,0,0),
            3 => array(0,0,0,0,0),
            4 => array(0,0,0,0,0),
            5 => array(0,0,0,0,0),
        );
        $end_min = array(
            0 => array(0,0,0,0,0),
            1 => array(90,90,90,90,0),
            2 => array(90,90,80,90,0),
            3 => array(0,0,0,0,0),
            4 => array(90,70,90,90,0),
            5 => array(90,90,90,60,0),
        );
        foreach($matches as $index=>$match){
            foreach ($users as $key=>$user) {
                DB::table('match_user')->insert(
                    [
                        'match_id' => $match,
                        'user_id' => $user,
                        'yellow_card' => $yellow_cards[$index][$key],
                        'red_card' => $red_cards[$index][$key],
                        'goals' => $goals[$index][$key],
                        'assists' => $assists[$index][$key],
                        'start_min' => $start_min[$index][$key],
                        'end_min' => $end_min[$index][$key],
                        'created_at' => date('Y:m:d H:m:s'),
                        'updated_at' => date('Y:m:d H:m:s'),
                    ]
                );
            }
        }
    }
}

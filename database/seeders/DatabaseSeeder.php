<?php

namespace Database\Seeders;

use App\Models\TeamLeagueSeasons;
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
        $this->call(StatusesSeeder::class);
        $this->call(RolesSeeder::class);
//        $this->call(HappySeeder::class);
        $this->notHappySeeders();
    }

    public function notHappySeeders()
    {
        $this->call(SeasonsSeeder::class);//Change count of seasons
        $this->call(LeagueSeeder::class);//Change count of leagues
        $this->call(LeagueSeasonsSeeder::class);
        $this->call(TeamSeeder::class);//Change count of teams
        $this->call(UsersSeeder::class);//Change count of users
        $this->call(TeamLeagueSeasonsSeeder::class);//Change count of teams in each league
        $this->call(MatchTeamsSeeder::class);
        $this->call(TeamUsersSeeder::class);//Change count of users in team

//        $this->call(TeamLeagueSeasonsSeeder::class);
//        $this->call(TeamUsersSeeder::class);
    }
}

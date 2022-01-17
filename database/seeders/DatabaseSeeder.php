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
        $this->call(SeasonsSeeder::class);
        $this->call(LeagueSeeder::class);
        $this->call(LeagueSeasonsSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(UsersSeeder::class);

//        $this->call(TeamLeagueSeasonsSeeder::class);
//        $this->call(TeamUsersSeeder::class);
    }
}

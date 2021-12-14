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
        // \App\Models\User::factory(10)->create();
        $this->call(StatusesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(HappySeeder::class);
//        $this->call(TeamSeeder::class);
//        $this->call(LeagueSeeder::class);
//        $this->call(SeasonsSeeder::class);
//        $this->call(LeagueSeasonsSeeder::class);
//        $this->call(TeamLeagueSeasonsSeeder::class);
//        $this->call(TeamUsersSeeder::class);
    }
}

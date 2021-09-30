<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leagues')->insert(
            [
                'id'=>'1',
                'name' => 'Ekstraklasa',
            ]
        );
        DB::table('leagues')->insert(
            [
                'id'=>'2',
                'name' => 'Druga liga',
            ]
        );
    }
}

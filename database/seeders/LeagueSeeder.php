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
                'name' => 'Ekstraliga',
            ]
        );
        DB::table('leagues')->insert(
            [
                'name' => 'Druga liga',
            ]
        );
        DB::table('leagues')->insert(
            [
                'name' => 'Trzecia liga',
            ]
        );
    }
}

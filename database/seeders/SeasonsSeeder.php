<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seasons')->insert(
            [
                'id'=>'1',
                'name' => 'Sezon pierwszy',
            ]
        );
        DB::table('seasons')->insert(
            [
                'id'=>'2',
                'name' => 'Sezon drugi',
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert(
            [
                'id' => '1',
                'league_id' => '1',
                'name' => 'Granit',
                'street' =>'Granitowa',
                'house_number'=>'10',
                'postal_code'=>'11-111',
                'town'=>'Bychawa'
            ]
        );
    }
}

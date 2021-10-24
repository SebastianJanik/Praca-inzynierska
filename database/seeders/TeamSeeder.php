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
                'status_id' => '1',
                'name' => 'Granit',
                'street' =>'Granitowa',
                'house_number'=>'10',
                'postal_code'=>'11-111',
                'town'=>'Bychawa'
            ]
        );
        DB::table('teams')->insert(
            [
                'id' => '2',
                'status_id' => '1',
                'name' => 'Druga druzyna',
                'street' =>'Druga',
                'house_number'=>'10',
                'postal_code'=>'11-111',
                'town'=>'Druga'
            ]
        );
        DB::table('teams')->insert(
            [
                'id' => '3',
                'status_id' => '1',
                'name' => 'Trzecia druzyna',
                'street' =>'Trzecia',
                'house_number'=>'10',
                'postal_code'=>'11-111',
                'town'=>'Trzecia'
            ]
        );
        for($i= 4; $i<10; $i++){
            DB::table('teams')->insert(
                [
                    'id' => $i,
                    'status_id' => '1',
                    'name' => $i. 'Druzyna',
                    'street' => $i.'ulica',
                    'house_number'=>'10',
                    'postal_code'=>'11-111',
                    'town'=> 'Miasto'.$i
                ]
            );
        }
    }
}

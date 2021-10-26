<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TeamUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 5; $i < 12; $i++) {
            DB::table('team_users')->insert(
                [
                    'team_id' => '1',
                    'user_id' => $i,
                    'status_id' => 9,
                    'join_date' => date('Y-m-d')
                ]
            );
            DB::table('users')->where('id', $i)
                ->update(['status_id', 13]);
        }
        DB::table('team_users')->insert(
            [
                'team_id' => '1',
                'user_id' => '3',
                'status_id' => 9,
                'join_date' => date('Y-m-d')
            ]
        );
        DB::table('users')->where('id', 3)
            ->update(['status_id', 13]);
    }
}

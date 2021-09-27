<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                'id' => '1',
                'name' => 'admin',
                'guard_name' => 'web'
            ]
        );
        DB::table('roles')->insert(
            [
                'id' => '2',
                'name' => 'player',
                'guard_name' => 'web'
            ]
        );
        DB::table('roles')->insert(
            [
                'id' => '3',
                'name' => 'coach',
                'guard_name' => 'web'
            ]
        );
        DB::table('roles')->insert(
            [
                'id' => '4',
                'name' => 'referee',
                'guard_name' => 'web'
            ]
        );
        DB::table('roles')->insert(
            [
                'id' => '5',
                'name' => 'user',
                'guard_name' => 'web'
            ]
        );
    }

}

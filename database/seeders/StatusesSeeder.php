<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(
            [
                'id'=>'1',
                'name' => 'active',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'2',
                'name' => 'inactive',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'3',
                'name' => 'blocked',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'4',
                'name' => 'suspended',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'5',
                'name' => 'waiting for acceptation by coach',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'6',
                'name' => 'accepted by coach',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'7',
                'name' => 'declined by coach',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'8',
                'name' => 'waiting for acceptation by admin',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'9',
                'name' => 'accepted by admin',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'10',
                'name' => 'declined by admin',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'11',
                'name' => 'timetable created',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'12',
                'name' => "timetable doesn't exist",
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'13',
                'name' => "assigned to the team",
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'14',
                'name' => "apply to be referee",
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'15',
                'name' => "incoming",
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'16',
                'name' => "completed ",
            ]
        );
    }
}

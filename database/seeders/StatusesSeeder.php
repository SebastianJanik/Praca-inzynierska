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
                'message' => 'Active',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'2',
                'name' => 'inactive',
                'completed ' => 'Inactive',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'3',
                'name' => 'blocked',
                'completed ' => 'Blocked',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'4',
                'name' => 'suspended',
                'completed ' => 'Suspended',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'5',
                'name' => 'waiting for acceptation by coach',
                'completed ' => 'Waiting for acceptation by coach',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'6',
                'name' => 'accepted by coach',
                'completed ' => 'Accepted by coach',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'7',
                'name' => 'declined by coach',
                'completed ' => 'Declined by coach',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'8',
                'name' => 'waiting for acceptation by admin',
                'completed ' => 'Waiting for acceptation by admin',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'9',
                'name' => 'accepted by admin',
                'completed ' => 'Accepted by admin',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'10',
                'name' => 'declined by admin',
                'completed ' => 'Declined by admin',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'11',
                'name' => 'timetable created',
                'completed ' => 'Timetable created',
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'12',
                'name' => "timetable doesn't exist",
                'completed ' => "Timetable doesn't exist",
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'13',
                'name' => "assigned to the team",
                'completed ' => "Assigned to the team",
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'14',
                'name' => "apply to be referee",
                'completed ' => "Apply to be referee",
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'15',
                'name' => "incoming",
                'completed ' => "Incoming",
            ]
        );
        DB::table('statuses')->insert(
            [
                'id'=>'16',
                'name' => "completed ",
                'completed ' => "Completed ",
            ]
        );
    }
}

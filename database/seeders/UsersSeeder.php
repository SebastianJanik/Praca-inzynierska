<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'=>'1',
            'name'=>'Admin',
            'surname'=>'Admin',
            'date_birth'=>'2000-01-01',
            'street'=>'street',
            'house_number'=>'20',
            'postal_code'=>'11-111',
            'town'=>'town',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('admin123')
                                   ]);

    }
}

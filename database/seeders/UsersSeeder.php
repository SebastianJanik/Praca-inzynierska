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
        DB::table('users')->insert(
            [
                'id' => '1',
                'name' => 'Admin',
                'surname' => 'Admin',
                'date_birth' => '2000-01-01',
                'street' => 'street',
                'house_number' => '20',
                'postal_code' => '11-111',
                'town' => 'town',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123')
            ]
        );
        DB::table('users')->insert(
            [
                'id' => '2',
                'name' => 'Player',
                'surname' => 'Player',
                'date_birth' => '2000-01-01',
                'street' => 'street',
                'house_number' => '20',
                'postal_code' => '11-111',
                'town' => 'town',
                'email' => 'player@player.com',
                'password' => Hash::make('admin123')
            ]
        );
        DB::table('users')->insert(
            [
                'id' => '3',
                'name' => 'Coach',
                'surname' => 'Coach',
                'date_birth' => '2000-01-01',
                'street' => 'street',
                'house_number' => '20',
                'postal_code' => '11-111',
                'town' => 'town',
                'email' => 'coach@coach.com',
                'password' => Hash::make('admin123')
            ]
        );
        DB::table('users')->insert(
            [
                'id' => '4',
                'name' => 'Referee',
                'surname' => 'Referee',
                'date_birth' => '2000-01-01',
                'street' => 'street',
                'house_number' => '20',
                'postal_code' => '11-111',
                'town' => 'town',
                'email' => 'referee@referee.com',
                'password' => Hash::make('admin123')
            ]
        );
        DB::table('users')->insert(
            [
                'id' => '5',
                'name' => 'User1',
                'surname' => 'User1',
                'date_birth' => '2000-01-01',
                'street' => 'street',
                'house_number' => '20',
                'postal_code' => '11-111',
                'town' => 'town',
                'email' => 'user1@user1.com',
                'password' => Hash::make('admin123')
            ]
        );
        DB::table('users')->insert(
            [
                'id' => '6',
                'name' => 'User2',
                'surname' => 'User2',
                'date_birth' => '2000-01-01',
                'street' => 'street',
                'house_number' => '20',
                'postal_code' => '11-111',
                'town' => 'town',
                'email' => 'user2@user2.com',
                'password' => Hash::make('admin123')
            ]
        );
        DB::table('users')->insert(
            [
                'id' => '7',
                'name' => 'User3',
                'surname' => 'User3',
                'date_birth' => '2000-01-01',
                'street' => 'street',
                'house_number' => '20',
                'postal_code' => '11-111',
                'town' => 'town',
                'email' => 'user3@user3.com',
                'password' => Hash::make('admin123')
            ]
        );
        DB::table('model_has_roles')->insert(
            [
                'role_id'=>'1',
                'model_type'=>'App\Models\user',
                'model_id'=>'1'
            ]
        );
        DB::table('model_has_roles')->insert(
            [
                'role_id'=>'2',
                'model_type'=>'App\Models\user',
                'model_id'=>'2'
            ]
        );
        DB::table('model_has_roles')->insert(
            [
                'role_id'=>'3',
                'model_type'=>'App\Models\user',
                'model_id'=>'3'
            ]
        );
        DB::table('model_has_roles')->insert(
            [
                'role_id'=>'4',
                'model_type'=>'App\Models\user',
                'model_id'=>'4'
            ]
        );
        DB::table('model_has_roles')->insert(
            [
                'role_id'=>'5',
                'model_type'=>'App\Models\user',
                'model_id'=>'5'
            ]
        );
        DB::table('model_has_roles')->insert(
            [
                'role_id'=>'5',
                'model_type'=>'App\Models\user',
                'model_id'=>'6'
            ]
        );
        DB::table('model_has_roles')->insert(
            [
                'role_id'=>'5',
                'model_type'=>'App\Models\user',
                'model_id'=>'7'
            ]
        );
    }
}

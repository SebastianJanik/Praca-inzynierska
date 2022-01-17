<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $name;
    private $roles;

    public function __construct()
    {
        $this->name = (new Role())->getTable();
        $this->roles = ['admin', 'player', 'coach', 'referee', 'user'];
    }

    public function run()
    {
        foreach ($this->roles as $role){
            DB::table($this->name)->insert(
                [
                    'name' => $role,
                    'guard_name' => 'web'
                ]
            );
        }
    }

}

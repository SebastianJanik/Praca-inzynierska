<?php

namespace Database\Seeders;

use App\Models\League;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $leagues;
    private $name;

    public function __construct()
    {
        $this->name = (new League())->getTable();
        $this->leagues = ['Ekstraliga', 'Druga liga', 'Trzecia liga'];
    }

    public function run()
    {
        foreach ($this->leagues as $league){
            DB::table($this->name)->insert(
                [
                    'name' => $league,
                ]
            );
        }
    }
}

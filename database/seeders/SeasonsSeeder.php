<?php

namespace Database\Seeders;

use App\Models\Season;
use App\Models\Statuses;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $modelStatuses;
    private $name;

    public function __construct()
    {
        $this->modelStatuses = new Statuses();
        $this->name = (new Season())->getTable();
    }
    public function run()
    {

        DB::table($this->name)->insert(
            [
                'status_id' => $this->modelStatuses->getStatus('inactive'),
                'name' => 'Sezon pierwszy',
            ]
        );
        DB::table($this->name)->insert(
            [
                'status_id' => $this->modelStatuses->getStatus('active'),
                'name' => 'Sezon drugi',
            ]
        );
    }
}

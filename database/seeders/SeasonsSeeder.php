<?php

namespace Database\Seeders;

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

    public function __construct()
    {
        $this->modelStatuses = new Statuses();
    }
    public function run()
    {

        DB::table('seasons')->insert(
            [
                'status_id' => $this->modelStatuses->getStatus('inactive'),
                'name' => 'Sezon pierwszy',
            ]
        );
        DB::table('seasons')->insert(
            [
                'status_id' => $this->modelStatuses->getStatus('active'),
                'name' => 'Sezon drugi',
            ]
        );
    }
}

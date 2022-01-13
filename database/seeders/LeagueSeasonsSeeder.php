<?php

namespace Database\Seeders;

use App\Models\Statuses;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeagueSeasonsSeeder extends Seeder
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
        $created = $this->modelStatuses->getStatus('timetable created');
        $notCreated = $this->modelStatuses->getStatus('timetable created');
        DB::table('league_season')->insert(
            [
                'id' => '1',
                'season_id' => '1',
                'league_id' => '1',
                'status_id' => $created
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '2',
                'season_id' => '1',
                'league_id' => '2',
                'status_id' => $created
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '3',
                'season_id' => '1',
                'league_id' => '3',
                'status_id' => $created
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '4',
                'season_id' => '1',
                'league_id' => null,
                'status_id' => $notCreated
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '4',
                'season_id' => '2',
                'league_id' => '1',
                'status_id' => '12'
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '5',
                'season_id' => '2',
                'league_id' => '2',
                'status_id' => '12'
            ]
        );
        DB::table('league_season')->insert(
            [
                'id' => '6',
                'season_id' => '2',
                'league_id' => null,
                'status_id' => '12'
            ]
        );
    }
}

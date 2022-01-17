<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
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
    private $name;

    public function __construct()
    {
        $this->modelStatuses = new Statuses();
        $this->name = (new LeagueSeasons())->getTable();
    }

    public function run()
    {
        $created = $this->modelStatuses->getStatus('timetable created');
        $notCreated = $this->modelStatuses->getStatus("timetable doesn't exist");
        $seasons = Season::all();
        $leagues = League::all();
        foreach ($seasons as $season){
            foreach ($leagues as $league){
                DB::table($this->name)->insert(
                    [
                        'season_id' => $season->id,
                        'league_id' => $league->id,
                        'status_id' => $created
                    ]
                );
            }
            DB::table($this->name)->insert(
                [
                    'season_id' => $season->id,
                    'league_id' => null,
                    'status_id' => $notCreated
                ]
            );
        }
    }
}

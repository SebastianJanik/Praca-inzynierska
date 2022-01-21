<?php

namespace Database\Seeders;

use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamLeagueSeasons;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamLeagueSeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $teamsNumber;
    private $name;

    public function __construct()
    {
        $this->name = (new TeamLeagueSeasons())->getTable();
        $this->teamsNumber = 7;
    }

    public function run()
    {
        $teams = Team::all()->toArray();
        $seasons = Season::all();
        foreach ($seasons as $season)
        {
            $league_seasons = LeagueSeasons::where('season_id', $season->id)->where('league_id', '!=', null)->get();
            $index = 0;
            foreach ($league_seasons as $league_season)
            {
                for($i=0; $i < $this->teamsNumber; $i++) {
                    DB::table($this->name)->insert(
                        [
                            'team_id' => $teams[$index]['id'],
                            'league_season_id' => $league_season->id
                        ]
                    );
                    $index++;
                }
            }
            $league_season = LeagueSeasons::where('season_id', $season->id)->whereNull('league_id')->first();
            for ($index; $index < count($teams); $index++)
            {
                DB::table($this->name)->insert(
                    [
                        'team_id' => $teams[$index]['id'],
                        'league_season_id' => $league_season->id
                    ]
                );
            }
        }

    }
}

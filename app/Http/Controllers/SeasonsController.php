<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Matches;
use App\Models\Round;
use App\Models\Season;
use App\Models\Team;

class SeasonsController extends Controller
{
    public function create()
    {
        $leagues = League::all();
        return view(
            'seasons.create',
            [
                'leagues' => $leagues,
            ]
        );
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'league_id' => 'required',
            ]
        );
        $teams = Team::where('league_id', $data['league_id'])->get();
        $teams_num = $teams->count();
        $season = Season::create($data['name']);

        //Create home and away game round for each team
        $season_rounds = 2 * ($teams_num - 1);
        $rounds = [];
        for ($round = 1; $round <= $season_rounds; $round++) {
            $rounds[] = Round::create(array('name' => $round, 'season_id' => $season->id));
        }

        //Create matches for every round
        $round_matches = round($teams_num / 2, 0, PHP_ROUND_HALF_UP);
        $matches = [];
        foreach ($rounds as $round) {
            for ($match = 0; $match < $round_matches; $match++) {
                $matches[] = Matches::create(
                    array
                    (
                        'date' => '2021-09-01',
                        'town' => ' ',
                        'protocol' => ' ',
                        'round_id' => $round->id,
                    )
                );
            }
        }
        //Create timetable for teams
        foreach ($matches as $match){
            for($team = 0; $team < $teams_num; $team++){

            }
        }
        dd($teams[0]->id);
        return view('seasons.store');
    }

    public function index()
    {
        return view('seasons.index');
    }
}

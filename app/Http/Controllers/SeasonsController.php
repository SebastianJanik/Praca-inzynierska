<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SeasonHelper;
use App\Models\League;
use App\Models\Matches;
use App\Models\MatchTeams;
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

        $season_helper = new SeasonHelper();

        $teams = Team::where('league_id', $data['league_id'])->get()->toArray();
        $season = Season::find('83');
        // $season = Season::create($data);
        $rounds = $season_helper->createRounds(count($teams), $season->id);
        $matches = $season_helper->createMatches(count($teams), $rounds);
        $teams_pairs = $season_helper->createMatchTeams($teams, $matches);

        return view('seasons.store');
    }

    public function index()
    {
        return view('seasons.index');
    }
}

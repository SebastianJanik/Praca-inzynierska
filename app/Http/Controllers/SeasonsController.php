<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SeasonHelper;
use App\Models\Season;
use App\Models\Team;

class SeasonsController extends Controller
{
    public function index()
    {
        return view('seasons.index');
    }

    public function create()
    {
        return view('seasons.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required|unique:seasons',
            ]
        );
        $season = Season::create($data);

//        $season_helper = new SeasonHelper();
//
//        $teams = Team::where('league_id', $data['league_id'])->get()->toArray();
//        $rounds = $season_helper->createRounds(count($teams), $season->id);
//        $matches = $season_helper->createMatches(count($teams), $rounds);
//        $teams_pairs = $season_helper->createMatchTeams($teams, $matches);

        return view('seasons.store');
    }

}

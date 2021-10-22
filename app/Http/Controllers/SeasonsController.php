<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SeasonHelper;
use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\Team;

class SeasonsController extends Controller
{
    public function index()
    {
        $seasons = Season::all();
        return view('seasons.index', compact('seasons'));
    }

    public function show($id)
    {
        $league_seasons = LeagueSeasons::where('season_id', $id)
            ->whereNotNull('league_id')->get();
        $leagues = League::whereIn('id', $league_seasons->pluck('league_id')->toArray())->get();
        $data = null;
        foreach ($league_seasons as $key=>$league_season)
            $data [] = [
                'league_season_id' => $league_season->id,
                'league' => $leagues[$key]
            ];
        return view('seasons.show', compact('data'));
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
        $data['status_id'] = '1';
        $season = Season::create($data);
        $leagues = League::all();
        foreach ($leagues as $league)
            LeagueSeasons::create(
                [
                    'season_id' => $season->id,
                    'league_id' => $league->id
                ]
            );
        LeagueSeasons::create(
            [
                'season_id' => $season->id,
                'league_id' => null
            ]
        );

        return view('seasons.store');
    }

}

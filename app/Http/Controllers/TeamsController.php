<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\LeagueTeams;
use App\Models\Season;
use App\Models\Team;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', ['teams' => $teams]);
    }

    public function create()
    {
        $leagues = League::all();
        return view('teams.create', compact('leagues'));
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'street' => 'required',
                'house_number' => 'required',
                'postal_code' => 'size:6',
                'town' => 'required',
                'league_id' => 'required'
            ]
        );
        if ($data['league_id'] == 'none') {
            $data['league_id'] = null;
        }
        Team::create($data);
        return view('teams.store');
    }

    public function edit($team_id)
    {
        $team = Team::find($team_id);
        return view('teams.edit', compact('team'));
    }

    public function assign($team_id)
    {
        $team = Team::find($team_id);
        $seasons = Season::all();
        $leagues = League::all();
        return view('teams.assign', compact('team', 'seasons', 'leagues'));
    }

    public function update()
    {

    }

    public function updateAssign($team_id)
    {
        $data = request()->validate(
            [
                'league_id' => 'required',
                'season_id' => 'required'
            ]
        );
        LeagueTeams::where('id', $team_id)->update($data);
    }
}

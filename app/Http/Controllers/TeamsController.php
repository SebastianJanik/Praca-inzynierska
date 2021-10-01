<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\LeagueTeams;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamLeagueSeasons;

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
            ]
        );
        Team::create($data);
        return view('teams.store');
    }

    public function edit($team_id)
    {
        $team = Team::find($team_id);
        return view('teams.edit', compact('team'));
    }

    public function editAssign($team_id)
    {
        $team = Team::find($team_id);
        $teamLeagueSeason = TeamLeagueSeasons::where('team_id', $team_id)->first();
        $leagueSeason = null;
        if($teamLeagueSeason) {
            $teamLeagueSeason->toArray();
            $leagueSeason = LeagueSeasons::where('id', $teamLeagueSeason['league_season_id'])->first();
        }
        $seasons = Season::all();
        $leagues = League::all();
        return view('teams.assign', compact('team', 'seasons', 'leagues', 'leagueSeason'));
    }

    public function update($team_id)
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'street' => 'required',
                'house_number' => 'required',
                'postal_code' => 'size:6',
                'town' => 'required',
            ]
        );
        Team::where('id', $team_id)->update($data);
        return $this->edit($team_id);
    }

    public function updateAssign($team_id)
    {
        $data['id'] = $team_id;
        $data = request()->validate(
            [
                'league_id' => 'required',
                'season_id' => 'required'
            ]
        );
        if ($data['league_id'] == 'none')
            $data['league_id'] = null;
        LeagueSeasons::updateOrCreate($data);
        return $this->editAssign($team_id);
    }
}

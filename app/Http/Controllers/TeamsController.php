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
        $seasons = Season::where('status_id', '1')->get();
        foreach ($seasons as $season)
            $seasons_id [] = $season->id;
        if(isset($seasons_id))
            $leagues_id = LeagueSeasons::select('league_id')->whereIn('season_id', $seasons_id)->get()->toArray();
        if(isset($leagues_id))
            $leagues = League::whereIn('id', $leagues_id)->get();
        $teamLeagueSeason = TeamLeagueSeasons::where('team_id', $team_id)->first();
        $leagueSeason = null;
        if($teamLeagueSeason) {
            $teamLeagueSeason->toArray();
            $leagueSeason = LeagueSeasons::where('id', $teamLeagueSeason['league_season_id'])->first();
        }
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
        if($data['league_id'] == 'none')
            $data['league_id'] = null;
        $leagueSeason = LeagueSeasons::where('league_id', $data['league_id'])->where('season_id', $data['season_id'])->first();
        $activeSeasons = Season::select('id')->where('status_id', '1')->get()->toArray();
        //choosing only records which season is currently active
        $leagueActiveSeasons = LeagueSeasons::select('id')->whereIn('season_id', $activeSeasons)->get();
        foreach ($leagueActiveSeasons as $leagueActiveSeason){
            $leagueActiveSeasons_id [] = $leagueActiveSeason['id'];
        }
        $teamLeagueSeasons = TeamLeagueSeasons::all()->where('team_id', $team_id)->whereIn('league_season_id', $leagueActiveSeasons_id)->first()->toArray();
        if($teamLeagueSeasons)
            TeamLeagueSeasons::where('team_id', $team_id,)
                ->where('league_season_id', $teamLeagueSeasons['league_season_id'])
                ->update(['league_season_id' => $leagueSeason->id]);
        return $this->editAssign($team_id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\Statuses;
use App\Models\Team;
use App\Models\TeamLeagueSeasons;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', ['teams' => $teams]);
    }

    public function show($id)
    {
        $modelStatusy = new Statuses();
        $team = Team::find($id);
        $season = Season::where("status_id", $modelStatusy->getStatus('incoming'))->first();
        if($season) {
            $leagues = $season->leagues;
            return view('teams.show', compact('team', 'season', 'leagues'));
        }
        return view('teams.show', compact('team'));
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
        $modelStatusy = new Statuses();
        $data['status_id'] = $modelStatusy->getStatus('inactive');
        Team::create($data);
        return view('teams.store');
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
        return redirect()->route('teams.edit', ['id' => $team_id]);
    }

    public function edit($team_id)
    {
        $team = Team::find($team_id);
        return view('teams.edit', compact('team'));
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
        if ($data['league_id'] == 'none') {
            $data['league_id'] = null;
        }
        $leagueSeason = LeagueSeasons::where('league_id', $data['league_id'])
            ->where('season_id', $data['season_id'])->first();
        $activeSeasons = Season::select('id')->where('status_id', '1')->get()->toArray();
        //choosing only records which season is currently active
        $leagueActiveSeasons = LeagueSeasons::select('id')
            ->whereIn('season_id', $activeSeasons)->get();
        foreach ($leagueActiveSeasons as $leagueActiveSeason) {
            $leagueActiveSeasons_id [] = $leagueActiveSeason['id'];
        }
        $teamLeagueSeasons = TeamLeagueSeasons::all()
            ->where('team_id', $team_id)
            ->whereIn('league_season_id', $leagueActiveSeasons_id)->first();
        if (!$teamLeagueSeasons) {
            TeamLeagueSeasons::create(
                [
                    'team_id' => $team_id,
                    'league_season_id' => $leagueSeason->id
                ]
            );
            return redirect()->route('teams.edit_assign', ['id' => $team_id]);
        }
        $teamLeagueSeasons->toArray();
        TeamLeagueSeasons::where('team_id', $team_id,)
            ->where('league_season_id', $teamLeagueSeasons['league_season_id'])
            ->update(['league_season_id' => $leagueSeason->id]);
        return redirect()->route('teams.edit_assign', ['id' => $team_id]);

    }

    public function changeTeamLeague($team_id)
    {

    }
}

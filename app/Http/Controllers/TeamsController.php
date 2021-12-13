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
            $league_season = $team->league_season->where('season_id', $season->id)->first();
            $leagues = $season->leagues;
            return view('teams.show', compact('team', 'season', 'leagues', 'league_season'));
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
        return redirect()->route('teams.store');
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

    public function changeTeamLeague($team_id)
    {
        $modelStatusy = new Statuses();
        $data = request()->validate(
            [
                'league' => 'required',
                'season' => 'required'
            ]
        );
        if($data['league'] == 'none')
            $data['league'] = null;

        $season = Season::find($data['season']);
        $leagues_in_season = $season->league_seasons;
        //league season passed by form
        $league_season = LeagueSeasons::where('season_id', $data['season'])
            ->where('league_id', $data['league'])->first();
        if ($league_season->status_id == $modelStatusy->getStatus('timetable created')){
            $message = "You can't move team, because timetable is already created";
            return redirect()->route('teams.show', $team_id)->with("message", $message);
        }
        $team_league_seasons = TeamLeagueSeasons::where('team_id', $team_id)->get();
        //checking if team is alocated in current season, if is change it's league
        foreach ($team_league_seasons as $team_league_season) {
            foreach ($leagues_in_season as $league_in_season){
                if ($team_league_season->league_season_id == $league_in_season->id){
                    $team_league_season->league_season_id = $league_season->id;
                    $team_league_season->save();
                    return redirect()->route('teams.show', $team_id);
                }
            }
        }
        return redirect()->route('teams.show', $team_id);
    }
}

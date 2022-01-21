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
    private $modelStatuses;

    public function __construct()
    {
        $this->modelStatuses = new Statuses();
    }

    public function index()
    {
        $teams = Team::all();
        return view('teams.index', ['teams' => $teams]);
    }

    public function show($id)
    {
        $team = Team::find($id);
        $season = Season::where("status_id", $this->modelStatuses->getStatus('incoming'))->first();
        $teamsSeasons = $team->league_season;
        foreach ($teamsSeasons as $teamsSeason)
        {
            $teamsSeason->seasonName = Season::find($teamsSeason->season_id)->name;
            $teamsSeason->leagueName =  League::find($teamsSeason->league_id) ? League::find($teamsSeason->league_id)->name : 'None';
            $teamsSeason->league_season_id = LeagueSeasons::where('season_id', $teamsSeason->season_id)->where('league_id', $teamsSeason->league_id)->first();
        }
        if($season) {
            $league_season = $team->league_season->where('season_id', $season->id)->first();
            $leagues = $season->leagues;
            return view('teams.show', compact('team', 'season', 'leagues', 'league_season', 'teamsSeasons'));
        }
        return view('teams.show', compact('team', 'teamsSeasons'));
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
        $data['status_id'] = $this->modelStatuses->getStatus('inactive');
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
        $data = request()->validate(
            [
                'league' => 'required',
                'season' => 'required'
            ]
        );
        if($data['league'] == 'none')
            $data['league'] = null;

        $season = Season::find($data['season']);
        $team = Team::find($team_id);
        $leagues_in_season = $season->league_seasons;
        //league season passed by form
        $league_season = LeagueSeasons::where('season_id', $data['season'])
            ->where('league_id', $data['league'])->first();

        if ($league_season->status_id == $this->modelStatuses->getStatus('timetable created'))
            return redirect()->route('teams.show', $team->id)->with('error', "You can't move team, because timetable is already created");

        if($team->league_seasonBySeasonId($season->id) && $team->league_seasonBySeasonId($season->id)->status_id == $this->modelStatuses->getStatus('timetable created'))
            return redirect()->route('teams.show', $team->id)->with('error', "You can't move team, because timetable is already created");

        $team_league_seasons = TeamLeagueSeasons::where('team_id', $team->id)->get();
        //checking if team is alocated in current season, if is change it's league
        foreach ($team_league_seasons as $team_league_season) {
            foreach ($leagues_in_season as $league_in_season){
                if ($team_league_season->league_season_id == $league_in_season->id){
                    $team_league_season->league_season_id = $league_season->id;
                    $team_league_season->save();
                    return redirect()->route('teams.show', $team->id)->with('success', 'Team moved');
                }
            }
        }
        //if not create a new record in database
        TeamLeagueSeasons::create(
            [
                'team_id' => $team_id,
                'league_season_id' => $league_season->id
            ]
        );
        return redirect()->route('teams.show', $team_id)->with('success', 'Team moved');
    }

    public function teamsInLeagueSeason($league_season_id)
    {
        $league_season = LeagueSeasons::find($league_season_id);
        $teams = $league_season->teams;
        $league = $league_season->league;
        $season = $league_season->season;
        if($teams->isEmpty())
            return view('teams.teams_in_league_season', compact('league', 'season'))->with('message', 'There are no teams');
        return view('teams.teams_in_league_season', compact( 'league', 'teams', 'season'));
    }
}

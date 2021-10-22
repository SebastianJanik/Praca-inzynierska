<?php

namespace App\Http\Controllers;

use App\Http\Helpers\MatchTeamHelper;
use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamLeagueSeasons;

class MatchTeamsController extends Controller
{
    public function create()
    {
        $seasons = Season::where('status_id', '1')->get();
        //If there's no active seasons return
        if(!$seasons)
            return view('home');
        foreach ($seasons as $season)
            $seasons_id [] = $season->id;
        $leagueSeasons = LeagueSeasons::whereIn('season_id', $seasons_id)->get();
        foreach ($leagueSeasons as $leagueSeason)
            $leagues_id [] = $leagueSeason->league_id;
        $leagues = League::whereIn('id', $leagues_id)->get();
        return view(
            'match_teams.create',
            [
                'seasons' => $seasons,
                'leagues' => $leagues
            ]
        );
    }

    public function store()
    {
        $data = request()->validate(
            [
                'season' => 'required',
                'league' => 'required'
            ]
        );
        $matchTeam_helper = new MatchTeamHelper();
        $leagueSeasons = LeagueSeasons::where('season_id', $data['season'])
            ->where('league_id', $data['league'])->first();
        if($leagueSeasons->status_id == '11')
            return 'Timetable already exist';
        $teamLeagueSeasons = TeamLeagueSeasons::where('league_season_id', $leagueSeasons->id)->get()->toArray();
        foreach ($teamLeagueSeasons as $teamLeagueSeason)
            $teams_id [] = $teamLeagueSeason['team_id'];
        if(!isset($teams_id) || count($teams_id) < 2)
            return 'Number of teams is to less to create timetable';
        $teams = Team::find($teams_id)->toArray();
        $rounds = $matchTeam_helper->createRounds(count($teams), $leagueSeasons->id);
        $matches = $matchTeam_helper->createMatches(count($teams), $rounds);
        $team_pairs = $matchTeam_helper->createMatchTeams($teams, $matches);
        $leagueSeasons->status_id = '11';
        $leagueSeasons->save();
        return view('home');
    }
}

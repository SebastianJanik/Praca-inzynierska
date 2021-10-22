<?php

namespace App\Http\Controllers;

use App\Http\Helpers\MatchTeamHelper;
use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Matches;
use App\Models\MatchTeams;
use App\Models\Round;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamLeagueSeasons;
use Illuminate\Http\Request;

class LeagueSeasonsController extends Controller
{

    public function index()
    {
        $leagueSeasons = LeagueSeasons::where('status_id', '11')->get();
        $data = null;
        foreach ($leagueSeasons as $leagueSeason){
            $data [] = array(
                'league_season_id' => $leagueSeason->id,
                'season' => Season::find($leagueSeason->season_id),
                'league' => League::find($leagueSeason->league_id)
            );
        }
        return view('match_teams.index', compact('data'));
    }

    public function show($league_season_id)
    {
        $matchTeamsHelper = new MatchTeamHelper();
        $rounds = Round::where('league_season_id', $league_season_id)->get();
        $team_league_seasons = TeamLeagueSeasons::where('league_season_id', $league_season_id)->get();
        foreach ($team_league_seasons as $item)
            $teams_id [] = $item->team_id;
        $teams = Team::find($teams_id);
        foreach ($rounds as $round)
            $rounds_id [] = $round->id;
        $matches = Matches::whereIn('round_id', $rounds_id)->get();
        foreach ($matches as $match)
            $matches_id [] = $match->id;
        $matchTeams = MatchTeams::whereIn('match_id', $matches_id)->get();

        foreach ($rounds as $round)
            $data [] = array (
                'matches' => $matchTeamsHelper->matchesBelongsToRound($round->id)
            );
        return view('match_teams.show', compact('teams', 'matches', 'matchTeams', 'data', 'rounds'));
    }
}

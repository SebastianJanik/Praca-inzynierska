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

use function PHPUnit\Framework\isEmpty;

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
        return view('league_seasons.index', compact('data'));
    }

    public function show($league_season_id)
    {
        $matchTeamsHelper = new MatchTeamHelper();

        $team_league_seasons = TeamLeagueSeasons::where('league_season_id', $league_season_id)->get();
        if(isEmpty($team_league_seasons))
            return "Table doesn't exist";

        $rounds = Round::where('league_season_id', $league_season_id)->get();
        foreach ($rounds as $round)
            $rounds_id [] = $round->id;
        $matches = Matches::whereIn('round_id', $rounds_id)->get();
        foreach ($matches as $match)
            $matches_id [] = $match->id;

        $teams = Team::find($team_league_seasons->pluck('team_id'));
        $matchTeams = MatchTeams::whereIn('match_id', $matches_id)->get();

        foreach ($rounds as $round)
            $data [] = array (
                'matches' => $matchTeamsHelper->matchesBelongsToRound($round->id)
            );
//        return view('league_seasons.show', compact('teams', 'matches', 'matchTeams', 'data', 'rounds'));
    }

    public function showTable($league_season_id)
    {
        $team_league_seasons = TeamLeagueSeasons::where('league_season_id', $league_season_id)->get();
        if(isEmpty($team_league_seasons))
            return "Table doesn't exist";

        $rounds = Round::where('league_season_id', $league_season_id)->get();
        if(isEmpty($rounds))
            return "Table doesn't exist";

        $matches = Matches::whereIn('round_id', $rounds->pluck('id'))->get();
        if(isEmpty($matches))
            return "Table doesn't exist";

        $matchTeams = MatchTeams::whereIn('match_id', $matches->pluck('id'))->get();
        $teams = Team::find($team_league_seasons->pluck('team_id'));

        return view('league_season.show_table');
    }
}

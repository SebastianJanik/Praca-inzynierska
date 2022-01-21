<?php

namespace App\Http\Controllers;

use App\Http\Helpers\MatchTeamHelper;
use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Matches;
use App\Models\MatchTeams;
use App\Models\Round;
use App\Models\Season;
use App\Models\Statuses;
use App\Models\Team;
use App\Models\TeamLeagueSeasons;


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
        if($team_league_seasons->isEmpty())
            return view('league_seasons.show')->with('error',"Timetable doesn't exist");
        $rounds = Round::where('league_season_id', $league_season_id)->get();
        if($rounds->isEmpty())
            return view('league_seasons.show')->with('error',"Timetable doesn't exist");

        $matches = Matches::whereIn('round_id', $rounds->pluck('id'))->get();
        if($matches->isEmpty())
            return view('league_seasons.show')->with('error',"Timetable doesn't exist");

        foreach ($rounds as $round)
            $data [] = (object)array (
                'matches' => $matchTeamsHelper->matchesBelongsToRound($round->id)
            );
        return view('league_seasons.show', compact('data', 'league_season_id'));
    }

    public function showTable($league_season_id)
    {
        $matchTeamsHelper = new MatchTeamHelper();
        $modelStatuses = new Statuses();
        $team_league_seasons = TeamLeagueSeasons::where('league_season_id', $league_season_id)->get();
        if($team_league_seasons->isEmpty())
            return view('league_seasons.show_table')->with('error',"Table doesn't exist");

        $rounds = Round::where('league_season_id', $league_season_id)->get();
        if($rounds->isEmpty())
            return view('league_seasons.show_table')->with('error',"Table doesn't exist");

        $matches = Matches::whereIn('round_id', $rounds->pluck('id'))->get();
        if($matches->isEmpty())
            return view('league_seasons.show_table')->with('error',"Table doesn't exist");

        $matches = $matches->where('status_id', $modelStatuses->getStatus('accepted by admin'));

        $teams = Team::find($team_league_seasons->pluck('team_id'));

        $data = [];
        foreach ($teams as $key=>$team){
            $matchTeams = MatchTeams::whereIn('match_id', $matches->pluck('id'))
                ->where('team_id', $team->id)->get();
            $data [] = (object)array(
                'team' => $team,
                'count' => count($matchTeams),
                'points' => 0,
                'goals_scored' => 0,
                'goals_conceded' => 0,
                'goals_diff' => 0,
                'wins' => 0,
                'draws' => 0,
                'loses' => 0,
            );
            foreach ($matchTeams as $matchTeam){
                $points = $matchTeamsHelper->matchTeamPoints($matchTeam->match_id, $matchTeam->team_id);
                $goals_scored = $matchTeamsHelper->matchTeamGoalsScored($matchTeam->match_id, $matchTeam->team_id);
                $goals_conceded = $matchTeamsHelper->matchTeamGoalsConceded($matchTeam->match_id, $matchTeam->team_id);
                if(!is_int($points) || !is_int($goals_scored) || !is_int($goals_conceded))
                    return 'Whoops something goes wrong';
                $goals_diff = $goals_scored - $goals_conceded;
                $data[$key]->points += $points;
                $data[$key]->goals_scored += $goals_scored;
                $data[$key]->goals_conceded += $goals_conceded;
                $data[$key]->goals_diff += $goals_diff;
            }
        }
        usort($data, function ($a, $b) : int {
            return
                ($b->points <=> $a->points) * 1000 +// price ASC
                ($b->goals_diff <=> $a->goals_diff) * 100 +// price ASC
                ($b->goals_scored <=> $a->goals_scored) * 10 +// inStock DESC
                ($a->goals_conceded <=> $b->goals_conceded); // isRecommended DESC
        });
        return view('league_seasons.show_table', compact('data'));
    }
}

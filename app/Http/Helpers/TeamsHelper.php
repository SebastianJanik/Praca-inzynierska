<?php

namespace App\Http\Helpers;

use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\TeamLeagueSeasons;

class TeamsHelper
{
    public function teamLeagueInCurrentSeason($team_id)
    {
        $season = Season::where('status_id', 1)->get();
        $team_league_season = TeamLeagueSeasons::where('team_id', $team_id)->get();
        $league_season = LeagueSeasons::where('season_id', $season->pluck('id'))
            ->whereIn('id', $team_league_season->pluck('league_season_id'))->first();
        return League::find($league_season->league_id);
    }
}

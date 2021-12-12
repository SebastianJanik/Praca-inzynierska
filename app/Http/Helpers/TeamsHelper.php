<?php

namespace App\Http\Helpers;

use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\Statuses;
use App\Models\TeamLeagueSeasons;

class TeamsHelper
{
    public function teamLeagueInCurrentSeason($team_id)
    {
        $modelStatusy = new Statuses();
        $season = Season::where('status_id', $modelStatusy->getStatus('incoming'))->first();
        $team_league_season = TeamLeagueSeasons::where('team_id', $team_id)->get();
        $league_season = LeagueSeasons::where('season_id', $season->id)
            ->whereIn('id', $team_league_season->pluck('league_season_id'))->first();
        return League::find($league_season->league_id);
    }
}

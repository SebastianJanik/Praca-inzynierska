<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'round_id',
        'status_id',
        'date',
        'town',
        'protocol',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, (new MatchUsers())->getTable(), 'match_id', 'user_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, (new MatchTeams())->getTable(), 'match_id', 'team_id');
    }

    public function matchesInActiveSeason(){
        $modelStatusy = new Statuses();
        $season = Season::where('status_id', $modelStatusy->getStatus('active'))->first();
        if(!$season)
            return null;
        $league_seasons = LeagueSeasons::where('season_id', $season->id)->get();
        $rounds = Round::whereIn('league_season_id', $league_seasons->pluck('id'))->get();
        return Matches::whereIn('round_id', $rounds->pluck('id'))->get();
    }

    public function closestMatches()
    {
        $statuses = new Statuses();
        $season = Season::where('status_id', $statuses->getStatus('active'))->first();
        if(!$season)
            return null;
        $league_seasons = $season->league_seasons;
        $closestMatch = null;
        foreach ($league_seasons as $league_season) {
            $league_matches[$league_season->id] = $league_season->matches;
            if(!$league_matches[$league_season->id]->isEmpty()) {
                $closestMatch[$league_season->id] = $league_matches[$league_season->id][0];
                foreach ($league_matches[$league_season->id] as $match) {
                    if ($match->date > $closestMatch[$league_season->id]->date) {
                        $closestMatch[$league_season->id] = $match;
                    }
                }
            }
        }
        return $closestMatch;
    }
}

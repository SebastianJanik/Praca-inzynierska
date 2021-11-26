<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'town',
        'protocol',
        'round_id'
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
        $season = Season::where('status_id', 1)->get();
        $league_seasons = LeagueSeasons::where('season_id', $season->pluck('id'))->get();
        $rounds = Round::whereIn('league_season_id', $league_seasons->pluck('id'))->get();
        return Matches::whereIn('round_id', $rounds->pluck('id'))->get();
    }

    public function closestMatches()
    {
        $statuses = new Statuses();
        $season = Season::where('status_id', $statuses->getStatus('active'))->first();
        $leagues = $season->league_seasons;
        return $leagues;
    }
}

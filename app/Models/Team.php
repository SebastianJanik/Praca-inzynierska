<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'street',
        'house_number',
        'postal_code',
        'town',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function matches()
    {
        return $this->belongsToMany(Matches::class, (new MatchTeams())->getTable(), 'team_id','match_id');
    }

    public function league_season()
    {
        return $this->belongsToMany(LeagueSeasons::class, (new TeamLeagueSeasons())->getTable(), "team_id", "league_season_id");
    }
}

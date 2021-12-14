<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueSeasons extends Model
{
    use HasFactory;

    protected $table = 'league_season';

    protected $fillable = [
        'season_id',
        'league_id',
        'status_id'
    ];

    public function league()
    {
        return $this->belongsTo(League::class);
    }
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class, "league_season_id");
    }

    public function matches()
    {
        return $this->hasManyThrough(Matches::class, Round::class,"league_season_id","round_id")->orderBy("date", "desc");
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, (new TeamLeagueSeasons())->getTable(), 'league_season_id', 'team_id' );
    }
}

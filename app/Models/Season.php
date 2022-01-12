<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'status_id'
    ];

    public function leagues(){
        return $this->belongsToMany(League::class);
    }

    public function league_seasons()
    {
        return $this->hasMany(LeagueSeasons::class);
    }

    //to nie dziala
    public function teams()
    {
        return $this->hasManyThrough(Team::class, TeamLeagueSeasons::class, LeagueSeasons::class, "season_id", "league_season_id", "id");
    }

    public function active_season()
    {
        return $this->where('status_id', (new Statuses())->getStatus('active'))->first();
    }
}

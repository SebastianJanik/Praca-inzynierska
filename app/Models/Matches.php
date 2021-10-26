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

    public function matchesInActiveSeason(){
        $season = Season::where('status_id', 1)->get();
        $league_seasons = LeagueSeasons::where('season_id', $season->pluck('id'))->get();
        $rounds = Round::whereIn('league_season_id', $league_seasons->pluck('id'))->get();
        return Matches::whereIn('round_id', $rounds->pluck('id'))->get();
    }

}

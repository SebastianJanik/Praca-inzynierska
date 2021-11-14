<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamLeagueSeasons extends Model
{
    use HasFactory;

    protected $table = 'league_season_team';

    protected $primaryKey = ['team_id', 'league_season_id'];
    public $incrementing = false;

    protected $fillable = [
        'team_id',
        'league_season_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueTeams extends Model
{
    use HasFactory;

    protected $fillable = [
        'league_id',
        'season_id',
    ];
}

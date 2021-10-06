<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueSeasons extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'league_id',
        'status_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'street',
        'house_number',
        'postal_code',
        'town',
        'leagues_season_id'
    ];

    public function matchTeams(){
        return $this->hasMany(MatchTeams::class);
    }

    public function teamUsers(){
        return $this->hasMany(TeamUsers::class);
    }

    public function leagues(){
        return $this->belongsTo(League::class);
    }
}

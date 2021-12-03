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
}
//return $this->belongsToMany(User::class, (new MatchUsers())->getTable(), 'match_id', 'user_id');

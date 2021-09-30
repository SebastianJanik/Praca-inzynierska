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

    public function matchTeams(){
        return $this->hasMany(MatchTeams::class);
    }

    public function matchUsers(){
        return $this->hasMany(MatchUsers::class);
    }

    public function rounds(){
        return $this->belongsTo(Round::class);
    }

}

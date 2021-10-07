<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchTeams extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'team_id',
        'goals',
        'host',
    ];

    public function matches(){
        return $this->belongsTo(Matches::class);
    }
    public function teams(){
        return $this->belongsTo(Team::class);
    }
}

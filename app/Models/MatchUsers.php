<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'user_id',
        'goals',
        'assists',
        'start_min',
        'end_min'
    ];
    public function matches(){
        return $this->belongsTo(Matches::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}

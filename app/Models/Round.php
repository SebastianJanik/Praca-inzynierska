<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $table = 'rounds';

    protected $fillable = [
        'name',
        'league_season_id'
    ];

    public function matches(){
        return $this->hasMany(Matches::class);
    }

    public function seasons(){
        return $this->belongsTo(Season::class);
    }
}

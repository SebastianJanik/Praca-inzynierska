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

    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

}

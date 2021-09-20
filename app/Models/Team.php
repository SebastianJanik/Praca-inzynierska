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
        'league_id'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function matches(){
        return $this->belongsToMany(Matches::class);
    }
}

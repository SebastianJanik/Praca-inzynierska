<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchUsers extends Model
{
    use HasFactory;

    public function matches(){
        return $this->belongsTo(Matches::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}

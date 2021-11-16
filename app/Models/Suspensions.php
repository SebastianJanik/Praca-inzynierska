<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspensions extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'match_id',
        'user_id',
        'end_match_id',
        'reason',
        'length',
        'matches_left',
    ];
}

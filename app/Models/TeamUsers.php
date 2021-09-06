<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamUsers extends Model
{
    protected $fillable = [
        'team_id',
        'user_id',
        'join_date',
        'left_date',
    ];
    use HasFactory;
}

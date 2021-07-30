<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'season_id'
    ];

    public function fmatches(){
        return $this->belongsToMany(Fmatch::class);
    }
}

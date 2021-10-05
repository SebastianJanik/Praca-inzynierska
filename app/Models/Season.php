<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status_id'
    ];

    public function rounds(){
        return $this->hasMany(Round::class);
    }
    public function leagues(){
        return $this->hasMany(League::class);
    }
}

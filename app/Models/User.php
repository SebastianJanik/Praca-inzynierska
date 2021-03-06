<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'name',
        'surname',
        'date_birth',
        'street',
        'house_number',
        'postal_code',
        'town',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allTeams()
    {
        return $this->belongsToMany(Team::class);
    }

    /*
     * Return user's actual team
     */
    public function team()
    {
        return $this->belongsToMany(Team::class)
            ->wherePivot('status_id', 9);
    }
    public function matches()
    {
        return $this->belongsToMany(Matches::class, (new MatchUsers())->getTable(), 'user_id','match_id');
    }
    public function suspensions()
    {
        return $this->hasMany(Suspensions::class);
    }
}

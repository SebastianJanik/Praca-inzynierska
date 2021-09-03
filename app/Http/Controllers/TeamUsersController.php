<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Models\User;

class TeamUsersController extends Controller
{
    public function apply()
    {
        $leagues = League::all();
        $teams = Team::all();
        return view('team_users.apply', array(
            'leagues' => $leagues,
            'teams' => $teams
        ));
//        return view('team_users.apply');
    }

    public function create()
    {
        $data = request()->all();
        $players = User::where(
            ['name' => $data['name']],
            ['surname' => $data['surname']],
        )->get();
        $teams = Team::all();
        return view('team_users.create', array(
            'players' => $players,
            'teams' => $teams,
        ));
    }

    public function store()
    {
        $data = request()->validate(
            [
                'team' => 'required',
            ]
        );
//        TeamUsers::create($data);
        return view('team_users.store');
    }
}

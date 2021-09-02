<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;

class TeamUsersController extends Controller
{
    public function find()
    {
        return view('team_users.find');
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

    }
}

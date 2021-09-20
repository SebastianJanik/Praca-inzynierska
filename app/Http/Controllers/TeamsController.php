<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Team;

class TeamsController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        $leagues = League::all();
        return view('teams.create', compact('leagues'));
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'street' => 'required',
                'house_number' => 'required',
                'postal_code' => 'size:6',
                'town' => 'required',
                'league_id' => 'required'
            ]
        );
        Team::create($data);
        return view('teams.store');
    }
}

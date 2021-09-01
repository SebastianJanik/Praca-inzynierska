<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TeamsController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'street' => 'required',
            'house_number' => 'required',
            'postal_code' => 'size:6',
            'town' => 'required'
                                    ]);
        Team::create($data);
        return view('teams.store');
    }
}

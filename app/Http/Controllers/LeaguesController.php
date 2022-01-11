<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Season;

class LeaguesController extends Controller
{
    public function create()
    {
        return view('leagues.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required|unique:leagues',
            ]
        );
        League::create($data);
        return view('leagues.store');
    }
}

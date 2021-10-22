<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Season;

class LeaguesController extends Controller
{
    public function index()
    {
        $leagues = League::all();
        return view('leagues.index', array('leagues'=>$leagues));
    }

    public function show ($league_seasons_id)
    {
        return view('leagues.show');
    }
    public function create()
    {
        return view('leagues.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required|unique:seasons',
            ]
        );
        League::create($data);
        return view('leagues.store');
    }
}

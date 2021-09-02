<?php

namespace App\Http\Controllers;

use App\Models\League;

class LeaguesController extends Controller
{
    public function index()
    {
        $leagues = League::all();
        return view('leagues.index', array('leagues'=>$leagues));
    }

    public function create()
    {
        return view('leagues.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required',
            ]
        );
        League::create($data);
        return view('leagues.store');
    }
}

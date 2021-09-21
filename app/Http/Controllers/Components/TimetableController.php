<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaguesResource;
use App\Http\Resources\SeasonsResource;
use App\Models\League;
use App\Models\Season;

class TimetableController extends Controller
{
    public function index(): array
    {
        return [
            'leagues' => LeaguesResource::collection(League::all()),
            'seasons' => SeasonsResource::collection(Season::all())
        ];
    }

    public function create(){
        return view ('timetable.create');
    }

    public function store(){
        $data = request()->validate(
            [
                'league'=>'required',
                'season'=>'required'
            ]
        );

    }
}

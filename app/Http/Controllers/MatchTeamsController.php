<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Season;

class MatchTeamsController extends Controller
{
    public function create()
    {
        $seasons = Season::all();
        $leagues = League::all();
        return view(
            'match_teams.create',
            [
                'seasons' => $seasons,
                'leagues' => $leagues
            ]
        );
    }

    public function store()
    {
    }
}

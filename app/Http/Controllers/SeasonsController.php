<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Round;
use App\Models\Season;

class SeasonsController extends Controller
{
    public function create()
    {
        return view('seasons.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'teams' => ['required', 'max:2', 'regex:/^([1-9])/'],
            ]
        );
        $season = Season::create($data);

        //Create home and away game round for each team
        $season_rounds = 2 * ($data['teams'] - 1);
        $rounds = [];
        for ($round = 1; $round <= $season_rounds; $round++) {
            $rounds[] = Round::create(array('name' => $round, 'season_id' => $season->id));
        }

        //Create matches for every round
        $round_matches = round($data['teams'] / 2, 0, PHP_ROUND_HALF_UP);
        $matches = [];
        foreach ($rounds as $round) {
            for ($match = 0; $match < $round_matches; $match++) {
                $matches[] = Matches::create(
                    array
                    (
                        'date' => '2021-09-01',
                        'town' => ' ',
                        'protocol' => ' ',
                        'round_id' => $round->id,
                    )
                );
            }
        }

        //Create
        return view('seasons.store');
    }
}

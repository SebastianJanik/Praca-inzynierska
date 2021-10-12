<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function edit($match_id)
    {
        $match = Matches::find($match_id);
        return view('matches.edit', compact('match'));
    }

    public function update($match_id)
    {

    }
}

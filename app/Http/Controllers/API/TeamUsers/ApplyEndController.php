<?php

namespace App\Http\Controllers\API\TeamUsers;

use App\Models\TeamUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplyEndController extends Controller
{
    public function store()
    {
        $data = request()->validate(
            [
                'league' => ' ',
            ]
        );
        $data['join_date'] = date('Y-m-d');
        $data['left_date'] = date('Y-m-d');
        $data['team_id'] = 1;
        $data['user_id'] = auth()->id();
        dd($data);
        return TeamUsers::create($data);
    }
}

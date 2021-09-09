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
                'league' => 'required',
                'team'=>'required',
            ]
        );
        $data['join_date'] = date('Y-m-d');
        $data['left_date'] = date('Y-m-d');
        $data['user_id'] = auth()->id();
        return view('team_users.store');
        dd($data);
        return TeamUsers::create($data);
    }
}

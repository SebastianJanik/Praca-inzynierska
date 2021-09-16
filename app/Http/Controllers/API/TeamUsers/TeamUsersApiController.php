<?php

namespace App\Http\Controllers\API\TeamUsers;

use App\Http\Resources\TeamUsers\TeamUsersCreateResource;
use App\Models\League;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Http\Controllers\Controller;

class TeamUsersApiController extends Controller
{
    public function index()
    {
        return [
            'leagues' => TeamUsersCreateResource::collection(League::all()),
            'teams' => TeamUsersCreateResource::collection(Team::all())
        ];
    }

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
        dd($data);
        return TeamUsers::create($data);
    }
}

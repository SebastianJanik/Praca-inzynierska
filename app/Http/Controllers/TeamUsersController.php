<?php

namespace App\Http\Controllers;

use App\Http\Resources\LeaguesResource;
use App\Http\Resources\TeamsResource;
use App\Models\League;
use App\Models\Team;
use App\Models\TeamUsers;

class TeamUsersController extends Controller
{
    public function create()
    {
        return view('team_users.create');
    }
    public function index(): array
    {
        return [
            'leagues' => LeaguesResource::collection(League::all()),
            'teams' => TeamsResource::collection(Team::all())
        ];
    }

    public function store()
    {
        $data = request()->validate(
            [
                'team'=>'required',
                'role'=>'required'
            ]
        );
        $data['join_date'] = date('Y-m-d');
        $data['left_date'] = date('Y-m-d');
        $data['user_id'] = auth()->id();
        $data['team_id'] = $data['team'];
        if ($data['role'] == 'player')
            $data['status'] = 'player waiting for acceptation';
        if($data['role'] == 'coach')
            $data['status'] = 'coach waiting for acceptation';
        return TeamUsers::create($data);
    }
}

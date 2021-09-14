<?php

namespace App\Http\Controllers\API\TeamUsers;

use App\Http\Resources\ApplyEndResource;
use App\Http\Resources\ApplyResource;
use App\Models\League;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeamUsersApiController extends Controller
{
    public function index()
    {
        return [
            'leagues' => ApplyResource::collection(League::all()),
            'teams' => ApplyEndResource::collection(Team::all())
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
        dd(auth()->id());
        dd($data);
        return TeamUsers::create($data);
    }
}

<?php

namespace App\Http\Controllers\API\TeamUsers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplyResource;
use App\Models\League;
use App\Models\Team;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function index()
    {
        return [
            'leagues' => ApplyResource::collection(League::all()),
            'teams' => ApplyResource::collection(Team::all())
            ];
    }

    public function store()
    {
        return view('team_users.store');
    }
}

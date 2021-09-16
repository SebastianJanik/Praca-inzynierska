<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Models\User;

class TeamUsersController extends Controller
{
    public function create()
    {
        return view('team_users.create');
    }
}

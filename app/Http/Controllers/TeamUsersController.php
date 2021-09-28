<?php

namespace App\Http\Controllers;

use App\Http\Resources\LeaguesResource;
use App\Http\Resources\TeamsResource;
use App\Models\League;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamUsersController extends Controller
{
    public function create()
    {
        return view('team_users.create');
    }

    public function createData(): array
    {
        return [
            'leagues' => LeaguesResource::collection(League::all()),
            'teams' => TeamsResource::collection(Team::all())
        ];
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
                'team' => 'required',
                'role' => 'required'
            ]
        );
        $data['join_date'] = date('Y-m-d');
        $data['left_date'] = date('Y-m-d');
        $data['user_id'] = auth()->id();
        $data['team_id'] = $data['team'];
        if ($data['role'] == 'player') {
            $data['status'] = 'player waiting for acceptation by coach';
        }
        if ($data['role'] == 'coach') {
            $data['status'] = 'coach waiting for acceptation';
        }
        return TeamUsers::create($data);
    }

    public function indexUsersAcceptCoach()
    {
        $coach_id = Auth::id();
        $team_id = TeamUsers::where('user_id', $coach_id)->first()->team_id;
        $status = 'player waiting for acceptation by coach';
        $users = TeamUsers::where('team_id', $team_id)->where('status', $status)->get();
        $users_id = [];
        foreach ($users as $user) {
            $users_id [] = $user->user_id;
        }
        $users = User::whereIn('id', $users_id)->get()->toArray();
        return view('team_users.accept_coach', compact('users'));
    }

    public function indexUsersAcceptAdmin()
    {
        return view('team_users.accept_admin');
    }

    public function storeUsersAcceptCoach()
    {
        $data = request()->validate(
            [
                'user_id' => 'required',
                'decline' => '',
                'accept' => '',
            ]
        );
        $user = TeamUsers::where('user_id', $data['user_id'])->first();
        if(isset($data['accept']))
            $user->status = 'player accepted by coach';
        if(isset($data['decline']))
            $user->status = 'player declined by coach';
        $user->save();
        return $this->indexUsersAcceptCoach();
    }
}

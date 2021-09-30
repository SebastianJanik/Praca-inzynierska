<?php

namespace App\Http\Controllers;

use App\Http\Helpers\TeamUsersHelper;
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
        $teamUsersHelper = new TeamUsersHelper();
        $status = 'player waiting for acceptation by coach';
        $users = $teamUsersHelper->usersWaitingForAccept($status);
        return view('team_users.accept_coach', compact('users'));
    }

    public function indexUsersAcceptAdmin()
    {
        $teamUsersHelper = new TeamUsersHelper();
        $status = 'player accepted by coach';
        $users = $teamUsersHelper->usersWaitingForAccept($status);
        return view('team_users.accept_admin', compact('users'));
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

    public function storeUsersAcceptAdmin()
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
            $user->status = 'player accepted by admin';
        if(isset($data['decline']))
            $user->status = 'player declined by admin';
        $user->save();
        return $this->indexUsersAcceptCoach();
    }
}

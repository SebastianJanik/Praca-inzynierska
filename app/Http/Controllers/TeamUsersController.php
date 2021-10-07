<?php

namespace App\Http\Controllers;

use App\Http\Helpers\TeamUsersHelper;
use App\Http\Resources\LeaguesResource;
use App\Http\Resources\TeamsResource;
use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamUsersController extends Controller
{
    public function create()
    {
        $seasons = Season::select('id')->where('status_id', 1)->get()->toArray();
        $leagues_id = LeagueSeasons::select('league_id')->whereIn('season_id', $seasons)->get()->toArray();
        $leagues = League::find($leagues_id)->toArray();
        dd($leagues);
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
            $data['status_id'] = '5';
        }
        if ($data['role'] == 'coach') {
            $data['status_id'] = '8';
        }
        return TeamUsers::create($data);
    }

    public function indexUsersAcceptCoach()
    {
        $teamUsersHelper = new TeamUsersHelper();
        $status = '5';
        $users = $teamUsersHelper->usersWaitingForAccept($status);
        return view('team_users.accept_coach', compact('users'));
    }

    public function indexUsersAcceptAdmin()
    {
        $teamUsersHelper = new TeamUsersHelper();
        $status = '6';
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
            $user->status = '6';
        if(isset($data['decline']))
            $user->status = '7';
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
            $user->status = '11';
        if(isset($data['decline']))
            $user->status = '12';
        $user->save();
        return $this->indexUsersAcceptCoach();
    }
}

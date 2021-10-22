<?php

namespace App\Http\Controllers;

use App\Http\Helpers\TeamUsersHelper;
use App\Http\Resources\LeaguesResource;
use App\Http\Resources\TeamsResource;
use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamLeagueSeasons;
use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class TeamUsersController extends Controller
{
    public function create()
    {
        $seasons = Season::where('status_id', 1)->get();
        $leagues_seasons = LeagueSeasons::where('season_id', $seasons->pluck('id'))->get();
        $leagues = League::find($leagues_seasons->pluck('league_id')->toArray());
        $team_league_seasons = TeamLeagueSeasons::whereIn('league_season_id', $leagues_seasons->pluck('id')->toArray());
        $teams = Team::find($team_league_seasons->pluck('team_id')->toArray());
        return view('team_users.create', compact('leagues_seasons', 'leagues' , 'team_league_seasons', 'teams'));
    }

    public function store()
    {
        $user = User::find(auth()->id());
        $team_user = TeamUsers::where('user_id', $user->id)->get();
        $data = request()->validate(
            [
                'team' => 'required',
                'role' => 'required'
            ]
        );
        $data['join_date'] = date('Y-m-d');
        $data['user_id'] = $user->id;
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
            $user->status_id = '6';
        if(isset($data['decline']))
            $user->status_id = '7';
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
            $user->status_id = '9';
        if(isset($data['decline']))
            $user->status_id = '10';
        $user->save();
        return $this->indexUsersAcceptAdmin();
    }
}

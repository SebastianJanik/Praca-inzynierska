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

class TeamUsersController extends Controller
{
    public function create()
    {
        return view('team_users.create');
    }

    public function createData(): array
    {
        $seasons = Season::select('id')->where('status_id', 1)->get()->toArray();
        $leagues_id = LeagueSeasons::select('league_id')->whereIn('season_id', $seasons)->get()->toArray();
        $leagues_seasons_id = LeagueSeasons::select('id')->whereIn('season_id', $seasons)->get()->toArray();
        $leagues_seasons = LeagueSeasons::whereIn('season_id', $seasons)->get()->toArray();
        $leagues = League::find($leagues_id)->toArray();
        $teams_id = TeamLeagueSeasons::select('team_id')->whereIn('league_season_id', $leagues_seasons_id)->get()->toArray();
        $team_league_seasons = TeamLeagueSeasons::whereIn('league_season_id', $leagues_seasons_id)->get()->toArray();
        $teams = Team::find($teams_id)->toArray();
        return [
            'leagues' => $leagues,
            'teams' => $teams,
            'league_season' => $leagues_seasons,
            'team_league_seasons' => $team_league_seasons
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
            $user->status_id = '11';
        if(isset($data['decline']))
            $user->status_id = '12';
        $user->save();
        return $this->indexUsersAcceptCoach();
    }
}

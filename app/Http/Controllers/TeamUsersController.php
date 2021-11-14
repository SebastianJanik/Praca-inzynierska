<?php

namespace App\Http\Controllers;

use App\Http\Helpers\TeamsHelper;
use App\Http\Helpers\TeamUsersHelper;
use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamLeagueSeasons;
use App\Models\TeamUsers;
use App\Models\User;


class TeamUsersController extends Controller
{
    public function create()
    {
        $teamHelper = new TeamsHelper();
        $seasons = Season::where('status_id', 1)->get();
        $leagues_seasons = LeagueSeasons::where('season_id', $seasons->pluck('id'))
            ->whereNotNull('league_id')->get();
        $leagues = League::find($leagues_seasons->pluck('league_id'));
        $team_league_seasons = TeamLeagueSeasons::whereIn('league_season_id', $leagues_seasons->pluck('id'))->get();
        $teams = Team::find($team_league_seasons->pluck('team_id'));
        $data = [];
        foreach ($teams as $team){
            $data [] = (object)array(
                'id' => $team->id,
                'name' => $team->name,
                'league' => $teamHelper->teamLeagueInCurrentSeason($team->id)
            );
        }
        return view('team_users.create', compact('data', 'leagues'));
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
        $user->status_id = 13;
        $user->save();
        return TeamUsers::create($data);
    }

    public function remove($id)
    {
        $user = User::find($id);
        $team_users = TeamUsers::where('user_id', $id)
            ->where('status_id', 9)->first();
        $team_users->status_id = 1;
        $team_users->left_date = date('Y-m-d');
        $team_users->save();
        $user->status_id = 1;
        $user->save();
        return redirect()->route('users.players_index');
    }

    public function indexUsersAcceptCoach()
    {
        $teamUsersHelper = new TeamUsersHelper();
        $users = $teamUsersHelper->playersWaitingForAccept();
        return view('team_users.accept_coach', compact('users'));
    }

    public function indexUsersAcceptAdmin()
    {
        $teamUsersHelper = new TeamUsersHelper();
        $data = $teamUsersHelper->usersWaitingForAccept();
        if($data->players->isEmpty() && $data->coaches->isEmpty() && $data->referee->isEmpty())
            $data = null;
        return view('team_users.accept_admin', compact('data'));
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
        return redirect()->route('team_users.accept_coach');
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
        return redirect()->route('team_users.accept_admin');
    }
}

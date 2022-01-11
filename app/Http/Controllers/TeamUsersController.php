<?php

namespace App\Http\Controllers;

use App\Http\Helpers\TeamsHelper;
use App\Http\Helpers\TeamUsersHelper;
use App\Models\League;
use App\Models\Statuses;
use App\Models\Season;
use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;


class TeamUsersController extends Controller
{
    public function create()
    {
        $user = User::find(Auth::id());
        if($user->hasAnyRole(['player', 'coach', 'referee', 'admin'])){
            return view('team_users.create')->with('message','Your role is actually assigned' );
        }
        $teamHelper = new TeamsHelper();
        $modelStatusy = new Statuses();
        $season = Season::where('status_id', $modelStatusy->getStatus('incoming'))->first();
        if(empty($season))
            return view('team_users.create')->with("message", "Theres no incoming season, you can't aplly right now");
        $leagues_seasons = $season->league_seasons;
        $leagues = League::find($leagues_seasons->pluck('league_id'));
        $teams = new Collection();
        foreach($leagues_seasons as $leagues_season){
            $teams = $teams->merge($leagues_season->teams);
        }
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
        $modelStatuses = new Statuses();
        $user = User::find(auth()->id());
        if($user->status_id != $modelStatuses->getStatus('active'))
            return redirect()->route('home')->with('error', "You can't aply right now");

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
            $data['status_id'] = $modelStatuses->getStatus('waiting for acceptation by coach');
        }
        if ($data['role'] == 'coach') {
            $data['status_id'] = $modelStatuses->getStatus('waiting for acceptation by admin');
        }
        $user->status_id = $modelStatuses->getStatus('assigned to the team');
        $user->save();
        TeamUsers::create($data);
        Notification::create(
            [
                'user_id' => $user->id,
                'title' => 'Application to the team',
                'description' => 'Your application is being reviewed'
            ]
        );
        return redirect()->route('home')->with('success', 'Your application was created succefuly');
    }

    public function remove($id)
    {
        $modelStatuses = new Statuses();
        $user = User::find($id);
        $team_users = TeamUsers::where('user_id', $id)
            ->where('status_id', $modelStatuses->getStatus('accepted by admin'))->first();
        $team_users->status_id = $modelStatuses->getStatus('inactive');
        $team_users->left_date = date('Y-m-d');
        $team_users->save();
        $user->status_id = $modelStatuses->getStatus('active');
        if($user->hasRole('player'))
            $user->removeRole('player');
        if($user->hasRole('coach'))
            $user->removeRole('coach');
        $user->assignRole('user');
        $user->save();
        Notification::create(
            [
                'user_id' => $user->id,
                'title' => 'Removed from the team',
                'description' => 'You have been removed from the team'
            ]
        );
        if(Auth::user()->hasRole('coach'))
            return redirect()->route('users.players_index')->with('success', 'User removed from the team');
        return redirect()->route('users.players_index_admin', $team_users->team_id)->with('success', 'User removed from the team');
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
        $modelStatuses = new Statuses();
        $data = request()->validate(
            [
                'user_id' => 'required',
                'decline' => '',
                'accept' => '',
            ]
        );
        $user = User::find($data['user_id']);
        $team_user = TeamUsers::where('user_id', $data['user_id'])->first();
        if(isset($data['accept'])){
            $team_user->status_id = $modelStatuses->getStatus('accepted by coach');
            $team_user->save();
            Notification::create(
                [
                    'user_id' => $user->id,
                    'title' => 'Accepted by coach',
                    'description' => "Your application was accepted by coach"
                ]
            );
            return redirect()->route('team_users.accept_coach')->with('success', 'Player accepted');
        }
        if(isset($data['decline'])){
            $team_user->status_id = $modelStatuses->getStatus('declined by coach');
            $team_user->save();
            $user->status_id = $modelStatuses->getStatus('active');
            $user->save();
            $team_user->forceDelete();
            Notification::create(
                [
                    'user_id' => $user->id,
                    'title' => 'Declined by coach',
                    'description' => "Your application was declined by coach"
                ]
            );
            return redirect()->route('team_users.accept_coach')->with('success', 'Player declined');
        }
        return redirect()->route('team_users.accept_coach');
    }

    public function storeUsersAcceptAdmin()
    {
        $modelStatuses = new Statuses();
        $data = request()->validate(
            [
                'user_id' => 'required',
                'decline' => '',
                'accept' => '',
                'role' => 'required',
            ]
        );
        $teamUser = TeamUsers::where('user_id', $data['user_id'])->first();
        $user = User::find($data['user_id']);
        switch($data['role']){
            case 'Referee' :
                $user->status_id = $modelStatuses->getStatus('active');
                $user->save();
                if(isset($data['accept'])){
                    $user->assignRole('referee');
                    Notification::create(
                        [
                            'user_id' => $user->id,
                            'title' => 'Accepted by admin',
                            'description' => "Congratulations ! You became a referee"
                        ]
                    );
                    return redirect()->route('team_users.accept_admin')->with('success', 'Referee accepted');
                }
                if(isset($data['decline'])){
                    Notification::create(
                        [
                            'user_id' => $user->id,
                            'title' => 'Declined by admin',
                            'description' => "Your application was declined by admin"
                        ]
                    );
                    return redirect()->route('team_users.accept_admin')->with('warning', 'Referee declined');
                }
                break;
            case 'Player' :
                if(isset($data['accept'])){
                    $teamUser->status_id = $modelStatuses->getStatus('accepted by admin');
                    $user->assignRole('player');
                    $teamUser->save();
                    Notification::create(
                        [
                            'user_id' => $user->id,
                            'title' => 'Accepted by admin',
                            'description' => "Congratulations ! You became a player"
                        ]
                    );
                    return redirect()->route('team_users.accept_admin')->with('success', 'Player accepted');
                }
                if(isset($data['decline'])){
                    $teamUser->status_id = $modelStatuses->getStatus('waiting for acceptation by coach');
                    $teamUser->save();
                    Notification::create(
                        [
                            'user_id' => $user->id,
                            'title' => 'Declined by admin',
                            'description' => "Your application was declined by admin"
                        ]
                    );
                    return redirect()->route('team_users.accept_admin')->with('warning', 'Player declined');
                }
                break;
            case 'Coach' :
                if(isset($data['accept'])){
                    $teamUser->status_id = $modelStatuses->getStatus('accepted by admin');
                    $user->assignRole('coach');
                    $teamUser->save();
                    Notification::create(
                        [
                            'user_id' => $user->id,
                            'title' => 'Accepted by admin',
                            'description' => "Congratulations ! You became a coach"
                        ]
                    );
                    return redirect()->route('team_users.accept_admin')->with('success', 'Coach accepted');
                }
                if(isset($data['decline'])) {
                    $teamUser->status_id = $modelStatuses->getStatus('active');
                    $teamUser->save();
                    $user->status_id = $modelStatuses->getStatus('active');
                    $user->save();
                    Notification::create(
                        [
                            'user_id' => $user->id,
                            'title' => 'Declined by admin',
                            'description' => "Your application was declined by admin"
                        ]
                    );
                    return redirect()->route('team_users.accept_admin')->with('warning', 'Coach declined');
                }
                break;
        }
        return redirect()->route('team_users.accept_admin');
    }
}

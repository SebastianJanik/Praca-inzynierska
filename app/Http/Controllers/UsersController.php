<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\MatchUsers;
use App\Models\Statuses;
use App\Models\Suspensions;
use App\Models\TeamUsers;
use App\Models\User;
use App\Models\Team;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    public function indexPlayersCoach()
    {
        $user = Auth::user();
        $coaches_team = TeamUsers::where('user_id', $user->id)->get();
        if(!$user->hasRole('coach'))
            return 'You are not a coach';
        $team_users = TeamUsers::where('team_id', $coaches_team->pluck('team_id'))
            ->whereIn('status_id', [6, 9])->get();
        $users = User::find($team_users->pluck('user_id'))
            ->where('id', '!=', $user->id);
        return view('users.players_index', compact('users'));
    }

    public function indexPlayersAdmin($team_id)
    {
        $users = Team::find($team_id)->acceptedUsers;
        return view('users.players_index', compact('users'));
    }

    public function showPlayer($id)
    {
        $modelStatusy = new Statuses();
        $logged_user = Auth::user();
        $logged_user_team = $logged_user->team;
        $user = User::find($id);
        $roles = $user->getRoleNames();
        $canRemove = false;
        if(($logged_user_team->first() && $user->team->first() && $logged_user_team->first()->id == $user->team->first()->id && $logged_user->hasRole('coach')) || $logged_user->hasRole('admin'))
            $canRemove = true;
        $status = Statuses::find($user->status_id);
        $match_users = MatchUsers::where('user_id', $id)->get();
        $all_goals = array_sum($match_users->pluck('goals')->toArray());
        $all_assists = array_sum($match_users->pluck('assists')->toArray());
        $all_minutes = array_sum($match_users->pluck('end_min')->toArray()) - array_sum(
                $match_users->pluck('start_min')->toArray()
            );
        $all_yellows = array_sum($match_users->pluck('yellow_card')->toArray());
        $all_reds = array_sum($match_users->pluck('red_card')->toArray());
        $matches = (new Matches())->matchesInActiveSeason();
        if(!$matches){
            $goals = 0;
            $assists = 0;
            $minutes = 0;
            $yellows = 0;
            $reds = 0;
        }else {
            $match_users = MatchUsers::where('user_id', $id)
                ->whereIn('match_id', $matches->pluck('id'))->get();
            $goals = array_sum($match_users->pluck('goals')->toArray());
            $assists = array_sum($match_users->pluck('assists')->toArray());
            $minutes = array_sum($match_users->pluck('end_min')->toArray()) - array_sum(
                    $match_users->pluck('start_min')->toArray()
                );
            $yellows = array_sum($match_users->pluck('yellow_card')->toArray());
            $reds = array_sum($match_users->pluck('red_card')->toArray());
        }
        $suspension = Suspensions::where('user_id', $user->id)
            ->where('status_id', $modelStatusy->getStatus('active'))->first();
        return view(
            'users.players_show',
            compact
            (
                'user',
                'roles',
                'status',
                'all_goals',
                'all_assists',
                'all_minutes',
                'all_yellows',
                'all_reds',
                'goals',
                'assists',
                'yellows',
                'reds',
                'minutes',
                'suspension',
                'canRemove'
            )
        );
    }
    public function createReferee()
    {
        $user = User::find(Auth::id());
        $message = null;
        $modelStatusy = new Statuses();
        if($user->hasAnyRole(['player', 'coach', 'referee', 'admin']))
            return view('users.referee_create')->with('error', 'Your role is actually assigned');
        if($user->status_id == $modelStatusy->getStatus('apply to be referee'))
            return view('users.referee_create')->with('error', 'You have already applied for this position');
        return view('users.referee_create');
    }

    public function storeReferee()
    {
        $modelStatuses = new Statuses();
        $user = User::find(Auth::id());
        $user->status_id = $modelStatuses->getStatus('apply to be referee');
        $user->save();
        Notifications::create(
            [
                'user_id' => $user->id,
                'title' => 'Application to become a referee',
                'description' => 'Your application is being reviewed'
            ]
        );
        return redirect()->route('home')->with('success', 'Your application was created succefuly');
    }

}

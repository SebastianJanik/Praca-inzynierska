<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\MatchUsers;
use App\Models\Statuses;
use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function indexPlayers()
    {
        $id = Auth::user()->id;
        $coaches_team = TeamUsers::where('user_id', $id)->get();
        if($coaches_team->isEmpty())
            return 'You are not a coach';
        $team_users = TeamUsers::where('team_id', $coaches_team->pluck('team_id'))
            ->whereIn('status_id', [6, 9])->get();
        $users = User::find($team_users->pluck('user_id'))
            ->where('id', '!=', $id);
        return view('users.players_index', compact('users'));
    }

    public function showPlayers($id)
    {
        $user = User::find($id);
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
        $match_users = MatchUsers::where('user_id', $id)
            ->whereIn('match_id', $matches->pluck('id'))->get();
        $goals = array_sum($match_users->pluck('goals')->toArray());
        $assists = array_sum($match_users->pluck('assists')->toArray());
        $minutes = array_sum($match_users->pluck('end_min')->toArray()) - array_sum($match_users->pluck('start_min')->toArray());
        $yellows = array_sum($match_users->pluck('yellow_card')->toArray());
        $reds = array_sum($match_users->pluck('red_card')->toArray());
        return view(
            'users.players_show',
            compact
            (
                'user',
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
                'minutes'
            )
        );
    }
    public function createReferee()
    {
        $user = User::find(Auth::id());
        $message = null;

        if($user->hasAnyRole(['player', 'coach', 'referre', 'admin']))
            $message = 'Your role is actually assigned';
        if($user->status_id == 14)
            $message = 'You have already applied for this position';
        return view('users.referee_create', compact('message'));
    }

    public function storeReferee()
    {
        $user = User::find(Auth::id());
        $user->status_id = 14;
        $user->save();
        return redirect()->route('users.referee_create');
    }

    public function suspendPlayer($user)
    {

    }
}

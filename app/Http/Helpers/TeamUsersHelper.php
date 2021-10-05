<?php

namespace App\Http\Helpers;

use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamUsersHelper
{
    public function usersWaitingForAccept($status){
        $coach_id = Auth::id();
        $team_id = TeamUsers::where('user_id', $coach_id)->first()->team_id;
        $users = TeamUsers::where('team_id', $team_id)->where('status_id', $status)->get();
        $users_id = [];
        foreach ($users as $user) {
            $users_id [] = $user->user_id;
        }
        return User::whereIn('id', $users_id)->get()->toArray();
    }
}

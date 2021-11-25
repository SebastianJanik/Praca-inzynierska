<?php

namespace App\Http\Helpers;

use App\Models\TeamUsers;

class UsersHelper
{
    public function checkIfHasTeam($user)
    {
        $teams = TeamUsers::where('user_id', $user->id)
            ->where('status_id', '!=', 2)->get();
        if($teams->isEmpty())
            return false;
        return true;
    }
}

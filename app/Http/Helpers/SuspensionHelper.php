<?php

namespace App\Http\Helpers;

use App\Models\Suspensions;
use App\Models\User;

class SuspensionHelper
{
    public function decreaseSuspension($suspension, $match_id)
    {
        $usersHelper = new UsersHelper();
        if($suspension->matches_left <= 1){
            $suspension->matches_left = 0;
            $suspension->status_id = 2;
            $suspension->end_match_id = $match_id;
            $user = User::find($suspension->user_id);
            if($usersHelper->checkIfHasTeam($user))
                $user->status_id = 13;
            else
                $user->status_id = 1;
            $user->save();
        }else{
            $suspension->matches_left --;
        }
        $suspension->save();
    }

    public function increaseSuspension($suspension)
    {
        $suspension->matches_left ++;
        $suspension->save();
    }
}

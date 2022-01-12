<?php

namespace App\Http\Helpers;

use App\Models\Statuses;
use App\Models\Notifications;
use App\Models\User;

class SuspensionHelper
{
    private $modelStatuses;

    public function __construct()
    {
        $this->modelStatuses = new Statuses();
    }

    public function decreaseSuspension($suspension, $match_id)
    {
        $usersHelper = new UsersHelper();
        if($suspension->matches_left <= 1){
            $suspension->matches_left = 0;
            $suspension->status_id = $this->modelStatuses->getStatus('inactive');
            $suspension->end_match_id = $match_id;
            $user = User::find($suspension->user_id);
            if($usersHelper->checkIfHasTeam($user))
                $user->status_id = $this->modelStatuses->getStatus('assigned to the team');
            else
                $user->status_id = $this->modelStatuses->getStatus('active');
            $user->save();
            Notifications::create(
                [
                    'user_id' => $user->id,
                    'title' => 'Suspension',
                    'description' => "Your suspension has expired"
                ]
            );
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

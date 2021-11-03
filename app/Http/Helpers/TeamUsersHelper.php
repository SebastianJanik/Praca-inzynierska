<?php

namespace App\Http\Helpers;

use App\Models\Team;
use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamUsersHelper
{
    public function playersWaitingForAccept()
    {
        $coach_id = Auth::id();
        $team_users = TeamUsers::where('user_id', $coach_id)
            ->where('status_id', 9)->get();
        if ($team_users->isEmpty()) {
            return null;
        }
        $users = TeamUsers::where('team_id', $team_users->pluck('team_id'))
            ->where('status_id', 5)->get();
        return User::whereIn('id', $users->pluck('user_id'))->get()->toArray();
    }

    public function usersWaitingForAccept(): object
    {
        $players = TeamUsers::where('status_id', 6)->get();
        $players = User::find($players->pluck('user_id'));
        foreach ($players as $player) {
            $player->role = 'Player';
            $teamId = TeamUsers::where('user_id', $player->id)->where('status_id', 6)->first();
            if($teamId != null)
                $player->team = Team::find($teamId->team_id);
        }
        $coaches = TeamUsers::where('status_id', 8)->get();
        $coaches = User::find($coaches->pluck('user_id'));
        foreach ($coaches as $coach) {
            $coach->role = 'Coach';
            $teamId = TeamUsers::where('user_id', $coach->id)->where('status_id', 8)->first();
            if($teamId != null)
                $coach->team = Team::find($teamId->team_id);
        }
        $referees = User::where('status_id', 14)->get();
        foreach ($referees as $referee) {
            $referee->role = 'Referee';
        }
        $data = array(
            'players' => $players,
            'coaches' => $coaches,
            'referee' => $referees
        );
        return (object)$data;
    }
}

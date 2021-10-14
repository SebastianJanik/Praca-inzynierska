<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\MatchTeams;
use App\Models\MatchUsers;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function edit($match_id)
    {
        $match = Matches::find($match_id);
        if(!isset($match))
            return "Match doesn't exist";
        $match_teams= MatchTeams::where('match_id', $match_id)->get();
        foreach ($match_teams as $match_team)
            $teams_id [] = $match_team->team_id;
        if(!isset($teams_id))
            return ' There are no teams in this match';
        $team_users = TeamUsers::whereIn('team_id', $teams_id)
            ->where('status_id', '9')->get();
        $users_id = null;
        foreach ($team_users as $team_user)
            $users_id [] = $team_user->user_id;
        $match_users = MatchUsers::where('match_id', $match_id);
        $users = User::find($users_id);
        $teams = Team::find($teams_id);
        return view('matches.edit', compact('match', 'users', 'teams', 'match_users', 'team_users' , 'match_teams'));
    }

    public function update($match_id)
    {
        $data = request()->all();
        foreach ($data['goals_team'] as $index=>$goals)
            MatchTeams::where('team_id', $index)
                ->where('match_id', $match_id)
                ->update(['goals' => $goals]);
        $users_id = null;
        foreach ($data['user_id'] as $id)
            $users_id [] = $id;
        if(!$users_id)
            return "To less users";
        foreach ($users_id as $user_id)
            MatchUsers::create(
                [
                    'match_id' => $match_id,
                    'user_id' => $user_id,
                    'yellow_card' => $data['yellow'][$user_id],
                    'red_card' => $data['red'][$user_id],
                    'start_min' => $data['start'][$user_id],
                    'end_min' => $data['end'][$user_id]
                ]
            );
        dd(request()->all());
    }
}

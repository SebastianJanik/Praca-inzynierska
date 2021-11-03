<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\MatchTeams;
use App\Models\MatchUsers;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Models\User;

class MatchesController extends Controller
{
    public function edit($match_id)
    {
        $match = Matches::find($match_id);
        if (!isset($match)) {
            return "Match doesn't exist";
        }
        $match_teams = MatchTeams::where('match_id', $match_id)->get();
        foreach ($match_teams as $match_team) {
            $teams_id [] = $match_team->team_id;
        }
        if (!isset($teams_id)) {
            return ' There are no teams in this match';
        }
        $team_users = TeamUsers::whereIn('team_id', $teams_id)
            ->where('status_id', '9')->get();
        $users_id = null;
        foreach ($team_users as $team_user) {
            $users_id [] = $team_user->user_id;
        }
        $match_users = MatchUsers::where('match_id', $match_id)->get();
        $users = User::find($users_id);
        $teams = Team::find($teams_id);
        return view('matches.edit', compact('match', 'users', 'teams', 'match_users', 'team_users', 'match_teams'));
    }

    public function update($match_id)
    {
        $data = request()->all();
        if (!isset($data['user_id'])) {
            return 'There are no users';
        }
        foreach ($data['user_id'] as $id) {
            $users_id [] = $id;
        }
        foreach ($data['goals_team'] as $index => $goals) {
            MatchTeams::where('team_id', $index)
                ->where('match_id', $match_id)
                ->update(['goals' => $goals]);
        }

        MatchUsers::where('match_id', $match_id)->delete();
        foreach ($users_id as $user_id) {
            MatchUsers::Create(
                [
                    'match_id' => $match_id,
                    'user_id' => $user_id,
                    'yellow_card' => $data['yellow'][$user_id],
                    'red_card' => $data['red'][$user_id],
                    'goals' => $data['goals'][$user_id],
                    'assists' => $data['assists'][$user_id],
                    'start_min' => $data['start'][$user_id],
                    'end_min' => $data['end'][$user_id]
                ]
            );
        }
        $match = Matches::find($match_id);
        $match->status_id = '16';
        $match->save();
        return redirect()->route('matches.edit', ['id' => $match_id]);
    }

    public function protocol($match_id)
    {
        Matches::find($match_id)->update(['status_id' => 16]);

        if(request()->get('restore'))
            Matches::where('id', $match_id)->update(['status_id' => 16]);
        if(request()->get('accept'))
            Matches::where('id', $match_id)->update(['status_id' => 9]);
        return redirect()->route('matches.edit', ['id' => $match_id]);
    }
}

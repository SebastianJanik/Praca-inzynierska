<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SuspensionHelper;
use App\Models\Matches;
use App\Models\MatchTeams;
use App\Models\MatchUsers;
use App\Models\Suspensions;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class MatchesController extends Controller
{
    public function edit($match_id)
    {
        $match = Matches::find($match_id);
        if (!isset($match)) {
            return "Match doesn't exist";
        }
        $teams = $match->teams;
        $match_teams = MatchTeams::where('match_id', $match_id)->get();
        $team_users = TeamUsers::whereIn('team_id', $teams->pluck('id'))
            ->where('status_id', '9')->get();
        $match_users = MatchUsers::where('match_id', $match_id)->get();
        $users = User::whereIn('id', $team_users->pluck('user_id')->toArray())
            ->where('status_id', 13)->get();
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
        $match->status_id = 16;
        $match->save();
        return redirect()->route('matches.edit', ['id' => $match_id]);
    }

    public function protocol($match_id)
    {
        $suspensionHelper = new SuspensionHelper();
        $match = Matches::find($match_id);
        $teams = $match->teams;
        $users = $match->users;
        $suspended_users = new Collection();
        foreach ($teams as $team)
            $suspended_users = $suspended_users->merge($team->users->where('status_id', 4));
        $suspensions = Suspensions::whereIn('user_id', $suspended_users->pluck('id'))
            ->where('status_id', 1)->get();
        foreach ($users as $user){
            $user->match = $user->matches;
        }
        if(request()->get('restore')) {
            $suspensionsCurrentMatch = Suspensions::where('match_id', $match_id)->get();
            $suspensionsEndedCurrentMatch = Suspensions::where('end_match_id', $match_id)->get();
            if(!$suspensionsCurrentMatch->isEmpty() || !$suspensionsEndedCurrentMatch->isEmpty()) {
                $data = null;
                foreach ($suspensionsCurrentMatch as $suspensionCurrentMatch) {
                    $data [] = (object)array(
                        'suspension' => $suspensionCurrentMatch,
                        'user' => $user = User::find($suspensionCurrentMatch->user_id),
                        'team' => $user->team->first(),
                    );
                }
                $dataEnd = null;
                foreach ($suspensionsEndedCurrentMatch as $suspensionEndedCurrentMatch) {
                    $dataEnd [] = (object)array(
                        'suspension' => $suspensionEndedCurrentMatch,
                        'user' => $user = User::find($suspensionEndedCurrentMatch->user_id),
                        'team' => $user->team->first(),
                    );
                }
                $match->status_id = 16;
                $match->save();
                $title = 'Suspensions that were imposed after this match';
                $secondtitle = 'Suspensions expired after this match';
                return view('suspensions.edit', compact('data', 'dataEnd', 'match_id', 'title', 'secondtitle'));
            }
            foreach ($suspensions as $suspension)
                $suspensionHelper->increaseSuspension($suspension);
            $match->status_id = 16;
            $match->save();
        }
        if(request()->get('accept')) {
            foreach ($suspensions as $suspension)
                $suspensionHelper->decreaseSuspension($suspension, $match_id);
            $match->status_id = 9;
            $match->save();
        }
        return redirect()->route('matches.edit', ['id' => $match_id]);
    }
}

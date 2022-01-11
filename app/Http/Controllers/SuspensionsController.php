<?php

namespace App\Http\Controllers;

use App\Models\Suspensions;
use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Http\Request;

class SuspensionsController extends Controller
{
    public function create()
    {
        $users = User::find([Request()->get('user_id')]);
        return view('suspensions.create', compact('users'));
    }

    public function store()
    {
        $data = Request()->all();
        foreach ($data['user_id'] as $user_id) {
            if (!isset($data['match_id'][$user_id])) {
                $data['match_id'][$user_id] = null;
            }
            Suspensions::create(
                [
                    'match_id' => $data['match_id'][$user_id],
                    'user_id' => $user_id,
                    'reason' => $data['reason'][$user_id],
                    'length' => $data['length'][$user_id],
                    'matches_left' => $data['length'][$user_id],
                ]
            );
            $user = User::find($user_id);
            $user->status_id = 4;
            $user->save();
        }

        return redirect()->route('users.players_show', $data['user_id'])->with('success', 'User suspended');
    }

    public function edit($suspension_id)
    {
        $data [] = (object)array(
            'suspension' => $suspension = Suspensions::find($suspension_id),
            'user' => $user = User::find($suspension->user_id),
            'team' => $user->team->first(),
        );
        $title = 'Edit suspension';
        return view('suspensions.edit', compact('data', 'title'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $suspensions = Suspensions::find($data['suspension_id']);
        foreach ($suspensions as $suspension) {
            $suspension->length = $data['length'][$suspension->id];
            $suspension->matches_left = $data['matches_left'][$suspension->id];
            $suspension->reason = $data['reason'][$suspension->id];
            $user = User::find($suspension->user_id);
            if ($suspension->matches_left == 0) {
                $team_user = TeamUsers::where('user_id', $user->id)->where('status_id', '!=', 2)->get();
                if (isset($data['match_id']))
                    $suspension->end_match_id = $data['match_id'];
                if(!$team_user->isEmpty())
                    $user->status_id = 13;
                else
                    $user->status_id = 1;
                $suspension->status_id = 2;
            }else {
                $suspension->status_id = 1;
                $user->status_id = 4;
            }
            $user->save();
            $suspension->save();
        }
        if (isset($data['match_id']))
            return redirect()->route('matches.edit', $data['match_id']);
        return redirect()->route('suspensions.edit', $data['suspension_id'])->with('success', 'User suspension updated');
    }

}

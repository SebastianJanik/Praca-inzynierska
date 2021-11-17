<?php

namespace App\Http\Controllers;

use App\Models\Suspensions;
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
        foreach($data['user_id'] as $user_id){
            if(!isset($data['match_id'][$user_id]))
                $data['match_id'][$user_id] = null;
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

        return redirect()->route('home');
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
        dd($request->all());
    }

}

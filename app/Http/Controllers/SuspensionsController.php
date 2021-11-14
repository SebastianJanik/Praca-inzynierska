<?php

namespace App\Http\Controllers;

use App\Models\Suspensions;
use App\Models\SuspensionUsers;
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
            $suspension = Suspensions::create(
                [
                    'match_id' => $data['match_id'][$user_id],
                    'reason' => $data['reason'][$user_id],
                    'length' => $data['length'][$user_id],
                    'matches_left' => $data['length'][$user_id],
                ]
            );
            SuspensionUsers::create(
                [
                    'user_id' => $user_id,
                    'suspension_id' => $suspension->id
                ]
            );
            $user = User::find($user_id);
            $user->status_id = 4;
            $user->save();
        }

        return redirect()->route('home');
    }

}

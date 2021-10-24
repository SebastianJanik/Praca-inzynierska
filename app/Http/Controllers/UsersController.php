<?php

namespace App\Http\Controllers;

use App\Models\TeamUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function indexPlayers ()
    {
        $id = Auth::user()->id;
        $team_users = TeamUsers::where('user_id', $id)->get();
        $team_users = TeamUsers::where('team_id', $team_users->pluck('team_id'))
            ->where('status_id', 9)->get();
        $users = User::find($team_users->pluck('user_id'))
            ->where('id', '!=', $id);
        return view('users.players_index', compact('users'));
    }
}

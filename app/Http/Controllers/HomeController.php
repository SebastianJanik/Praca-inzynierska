<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Matches;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $modelsMatch = new Matches();
        $user = Auth::user();
        $role = $user->roles->first();
        $team = $user->team->first();
        $today = date("Y-m-d H:m:s");
        $birthday = false;
        if ($user->date_birth == $today) {
            $birthday = true;
        }
        $datedif = strtotime($today) - strtotime($user->created_at);
        $days = intval(floor($datedif / (60 * 60 * 24)));
        $league_matches = $modelsMatch->closestMatches();
        $matches = null;
        if (!$league_matches == null) {
        foreach ($league_matches as $key => $league_match)
            $matches [] = (object)array(
                "league" => League::find(LeagueSeasons::find($key)->league_id),
                "match" => $league_match,
                "teams" => $league_match->teams
            );
        }
        $data = (object)array(
            "user" => $user,
            "role" => $role,
            "team" => $team,
            "birthday" => $birthday,
            "days" => $days,
            "matches" => $matches
        );
        return view('home', compact('data'));
    }
}

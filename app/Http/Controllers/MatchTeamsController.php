<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchTeamsController extends Controller
{
    public function create(){
        return view('matchteams.create');
    }
}

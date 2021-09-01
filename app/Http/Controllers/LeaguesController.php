<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaguesController extends Controller
{
    public function create()
    {
        return view('leagues.create');
    }
}

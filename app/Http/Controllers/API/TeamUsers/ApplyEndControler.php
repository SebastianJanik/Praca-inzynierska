<?php

namespace App\Http\Controllers;

use App\Models\TeamUsers;
use Illuminate\Http\Request;

class ApplyEndControler extends Controller
{
    public function store()
    {
        $data = request()->validate(
            [
                'team' => 'required',
            ]
        );
        return TeamUsers::create($data);
    }
}

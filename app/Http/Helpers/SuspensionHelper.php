<?php

namespace App\Http\Helpers;

class SuspensionHelper
{
    public function decreaseSuspension($suspension, $match_id)
    {
        if($suspension->matches_left == 1){
            $suspension->matches_left --;
            $suspension->status_id = 2;
            $suspension->end_match_id = $match_id;
            $suspension->save();
        }
    }
}

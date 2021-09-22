<?php

namespace App\Http\Helpers;

use App\Models\Matches;
use App\Models\MatchTeams;
use App\Models\Round;

class SeasonHelper
{
    public function createRounds($teams_num, $season_id): array
    {
        $season_rounds = 2 * ($teams_num - 1);
        $rounds = [];
        for ($round = 1; $round <= $season_rounds; $round++) {
            $rounds [] = Round::create(
                [
                    'name' => $round,
                    'season_id' => $season_id
                ]
            );
        }
        return $rounds;
    }

    public function createMatches($teams_num, $rounds): array
    {
        $matches_in_round = round($teams_num / 2, 0, PHP_ROUND_HALF_UP);
        $matches = [];
        foreach ($rounds as $round) {
            for ($match = 0; $match < $matches_in_round; $match++) {
                $matches[] = Matches::create(
                    [
                        'date' => '2021-09-01',
                        'town' => ' ',
                        'protocol' => ' ',
                        'round_id' => $round->id,
                    ]
                );
            }
        }
        return $matches;
    }

    public function createMatchTeams($teams)
    {
//        $temp = array();
//        foreach ($teams as $team)
//            $temp [] = $team['name'];
//        $tab = array();
        $temp = ['1','2','3','4'];
        $max = count($temp);
        $half = $max/2;
        $index = 0;
        // first iteration
        for($i = 0; $i < $half; $i++){
            $tab [] = array($temp[$i], $temp[$max - $i - 1]);
        }
        // repeated iterations
        for($i = 0; $i <= $half ; $i++){
            $tab [] = array($temp[0], $temp[$max - 1]);
            $test = 2;
            for($j = $max - $i; $j < $half - 1; $j++){
                $tab [] = array($temp[$j], $temp[$j - $test]);
                $test ++;
            }
        }
        dd($tab);
    }
}

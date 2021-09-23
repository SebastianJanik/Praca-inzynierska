<?php

namespace App\Http\Helpers;

use App\Models\Matches;
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
        $temp = ['1', '2', '3', '4', '5','6','7', '8', '9','10','11','12','13','14'];
        $max = count($temp);
        $size = $max - 1;
        $half = $max / 2;
        $index = 0;
        // first iteration
        for ($i = 0; $i < $half; $i++) {
            $tab [] = array($temp[$i], $temp[$size - $i]);
        }
        // repeated iterations
        $index = 0;
        for ($i = 0; $i < $size - 1; $i++) {
            $tab [] = array($temp[0], $temp[$size - $i - 1]);
            for ($j = 0; ($size - $i + $j <= $size) && ($j < $half - 1); $j++) {
                $index = $size - $i - $j - 2;
                if($index <= 0)
                    $index = $size + $index;
                $tab [] = array($temp[$size - $i + $j], $temp[$index]);
            }
            if ($j < $half - 1) {
                for ($k = 1; $j < $half - 1; $j++ && $k++) {
                    $tab [] = array($temp[$k], $temp[$index - $k]);
                }
            }
        }
        foreach ($tab as $index => $t) {
            echo $index . ".  ";
            var_dump($t);
            echo "<br>";
        }
        die();
    }
}

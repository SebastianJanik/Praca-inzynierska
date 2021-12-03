<?php

namespace App\Http\Helpers;

use App\Models\Matches;
use App\Models\MatchTeams;
use App\Models\Round;
use App\Models\Statuses;
use App\Models\Team;

class MatchTeamHelper
{
    public function createRounds($teams_num, $league_season_id): array
    {
        $rounds_num = $teams_num;
        if($teams_num % 2 == 0)
            $rounds_num--;
        $rounds = [];
        for ($round = 1; $round <= $rounds_num; $round++) {
            $rounds[] = Round::create(
                [
                    'name' => $round,
                    'league_season_id' => $league_season_id
                ]
            );
        }
        return $rounds;
    }

    public function createMatches($teams_num, $rounds): array
    {
        $modelStatusy = new Statuses();
        $matches_in_round = round($teams_num / 2, 0, PHP_ROUND_HALF_UP);
        $matches = [];
        foreach ($rounds as $round) {
            for ($match = 0; $match < $matches_in_round; $match++) {
                $matches[] = Matches::create(
                    [
                        'status_id' => $modelStatusy->getStatus('incoming'),
                        'round_id' => $round->id,
                    ]
                );
            }
        }
        return $matches;
    }

    public function createMatchTeams($teams, $matches)
    {
        foreach ($teams as $team) {
            $teams_id[] = $team['id'];
        }
        $teams_pairs = $this->teamsPairs($teams_id);
        foreach($teams_pairs as $team_pair){
            $teams_pairs [] = array($team_pair[1], $team_pair[0]);
        }
        foreach ($matches as $index => $match) {
            $match_teams[] = MatchTeams::create(
                [
                    'match_id' => $match->id,
                    'team_id' => $teams_pairs[$index][0],
                    'host' => true,
                ]
            );
            $match_teams[] = MatchTeams::create(
                [
                    'match_id' => $match->id,
                    'team_id' => $teams_pairs[$index][1],
                    'host' => false,
                ]
            );
        }
        return $match_teams;
    }

    public function teamsPairs($temp)
    {
        // $temp = ['1', '2', '3', '4', '5','6','7', '8', '9','10','11','12','13','14'];
        if (count($temp) % 2 != 0)
            $temp[] = null; //null means pause
        $max = count($temp);
        $size = $max - 1;
        $half = $max / 2;
        $index = 0;
        // first iteration
        for ($i = 0; $i < $half; $i++) {
            $tab[] = array($temp[$i], $temp[$size - $i]);
        }
        // repeated iterations
        $index = 0;
        for ($i = 0; $i < $size - 1; $i++) {
            $tab[] = array($temp[0], $temp[$size - $i - 1]);
            for ($j = 0; ($size - $i + $j <= $size) && ($j < $half - 1); $j++) {
                $index = $size - $i - $j - 2;
                if ($index <= 0)
                    $index = $size + $index;
                $tab[] = array($temp[$size - $i + $j], $temp[$index]);
            }
            if ($j < $half - 1) {
                for ($k = 1; $j < $half - 1; $j++ && $k++) {
                    $tab[] = array($temp[$k], $temp[$index - $k]);
                }
            }
        }
        return $tab;
    }

    public function matchesBelongsToRound($round_id)
    {
        $matches = Matches::where('round_id', $round_id)->get();
        $data = [];
        foreach ($matches as $match)
            $data [] = (object)array(
                'match' => $match,
                'match_teams' => $this->matchTeamsBelongsToMatch($match['id'])
            );
        return $data;
    }

    public function matchTeamsBelongsToMatch($match_id)
    {
        $matchTeams = MatchTeams::where('match_id', $match_id)->get();
        $data = [];
        foreach ($matchTeams as $matchTeam)
            $data [] = (object)array(
                'id' => $matchTeam->id,
                'team' => Team::find($matchTeam->team_id),
                'goals' => $matchTeam->goals,
                'host' => $matchTeam->host
            );
        foreach ($data as $item){
            if($item->team == null) {
                $item->team = (object)['name' => 'PAUSE'];
            }
        }
        return $data;
    }

    public function matchTeamPoints($match_id, $team_id)
    {
        $match_team = MatchTeams::where('match_id', $match_id)
            ->where('team_id', $team_id)->first();
        $match_team2 = MatchTeams::where('match_id', $match_id)
            ->where('team_id', '!=', $team_id)->first();
        if(!$match_team)
            return null;
        if(!isset($match_team->goals) || !isset($match_team2->goals))
            return null;

        if(!$match_team2)
            return 0;
        if($match_team->goals > $match_team2->goals)
            return 3;
        if($match_team->goals < $match_team2->goals)
            return 0;
        if($match_team->goals == $match_team2->goals)
            return 1;

        return null;
    }
    public function matchTeamGoalsScored($match_id, $team_id)
    {
        $match_team = MatchTeams::where('match_id', $match_id)
            ->where('team_id', $team_id)->first();
        if(!$match_team)
            return null;
        if(!isset($match_team->goals))
            return null;
        return $match_team->goals;
    }
    public function matchTeamGoalsConceded($match_id, $team_id)
    {
        $match_team = MatchTeams::where('match_id', $match_id)
            ->where('team_id', '!=', $team_id)->first();
        if(!$match_team)
            return null;
        if(!isset($match_team->goals))
            return null;
        return $match_team->goals;
    }


}

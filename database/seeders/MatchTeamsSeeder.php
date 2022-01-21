<?php

namespace Database\Seeders;

use App\Http\Helpers\MatchTeamHelper;
use App\Models\LeagueSeasons;
use App\Models\Matches;
use App\Models\MatchTeams;
use App\Models\Round;
use App\Models\Statuses;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $roundsTableName;
    private $matchesTableName;
    private $matchTeamsTableName;
    private $modelStatuses;
    private $matchTeamHelper;

    public function __construct()
    {
        $this->roundsTableName = (new Round())->getTable();
        $this->matchesTableName = (new Matches())->getTable();
        $this->matchTeamsTableName = (new MatchTeams())->getTable();
        $this->modelStatuses = new Statuses();
        $this->matchTeamHelper = new MatchTeamHelper();
    }

    public function run()
    {
        $leagueSeasons = LeagueSeasons::whereNotNull('league_id')->get();
        foreach ($leagueSeasons as $leagueSeason)
        {
            $teams = $leagueSeason->teams;
            $rounds = $this->createRounds(count($teams), $leagueSeason->id);
            $matches = $this->createMatches(count($teams), $rounds);
            $team_pairs = $this->createMatchTeams($teams, $matches);
        }
    }

    public function createRounds($teams_num, $league_season_id): array
    {
        $rounds_num = $teams_num;
        if($teams_num % 2 == 0)
            $rounds_num--;
        $rounds = [];
        for ($round = 1; $round <= $rounds_num; $round++) {
            $rounds[] = DB::table($this->roundsTableName)->insertGetId(
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
        $matches_in_round = round($teams_num / 2, 0, PHP_ROUND_HALF_UP);
        $matches = [];
        foreach ($rounds as $round) {
            for ($match = 0; $match < $matches_in_round; $match++) {
                $matches[] = DB::table($this->matchesTableName)->insertGetId(
                    [
                        'status_id' => $this->modelStatuses->getStatus('incoming'),
                        'round_id' => $round,
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
        $teams_pairs = $this->matchTeamHelper->teamsPairs($teams_id);
        foreach($teams_pairs as $team_pair){
            $teams_pairs [] = array($team_pair[1], $team_pair[0]);
        }
        foreach ($matches as $index => $match) {
            $match_teams[] = DB::table($this->matchTeamsTableName)->insert(
                [
                    'match_id' => $match,
                    'team_id' => $teams_pairs[$index][0],
                    'host' => true,
                ]
            );
            $match_teams[] = DB::table($this->matchTeamsTableName)->insert(
                [
                    'match_id' => $match,
                    'team_id' => $teams_pairs[$index][1],
                    'host' => false,
                ]
            );
        }
        return $match_teams;
    }
}

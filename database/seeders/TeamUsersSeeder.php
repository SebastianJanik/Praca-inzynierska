<?php

namespace Database\Seeders;

use App\Models\Statuses;
use App\Models\Team;
use App\Models\TeamUsers;
use App\Models\User;
use Carbon\Traits\Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TeamUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $players;
    private $coaches;
    private $playersTeamNumber;
    private $tableName;
    private $usersTableName;
    private $teams;
    private $modelSatuses;

    public function __construct()
    {
        $this->tableName = (new TeamUsers())->getTable();
        $this->usersTableName = (new User())->getTable();
        $this->players = User::role('player')->get();
        $this->playersTeamNumber = 5;
        $this->teams = Team::all();
        $this->coaches = User::role('coach')->get();
        $this->modelSatuses = new Statuses();
    }

    public function run()
    {
        $playersIndex = 0;
        $coachesIndex = 0;
        $joinDate = Date('Y-m-d');
        $acceptedStatus = $this->modelSatuses->getStatus('accepted by admin');
        $assignedStatus = $this->modelSatuses->getStatus('assigned to the team');
        foreach ($this->teams as $team) {
            for ($i=0; $i < $this->playersTeamNumber; $i ++)
            {
                DB::table($this->tableName)->insert(
                    [
                        'team_id' => $team->id,
                        'user_id' => $this->players[$playersIndex]->id,
                        'status_id' => $acceptedStatus,
                        'join_date' => $joinDate
                    ]
                );
                DB::table($this->usersTableName)->where('id', $this->players[$playersIndex]->id)
                    ->update(['status_id' => $assignedStatus]);
                $playersIndex++;
            }
            DB::table($this->tableName)->insert(
                [
                    'team_id' => $team->id,
                    'user_id' => $this->coaches[$coachesIndex]->id,
                    'status_id' => $acceptedStatus,
                    'join_date' => $joinDate
                ]
            );
            DB::table($this->usersTableName)->where('id', $this->coaches[$coachesIndex]->id)
                ->update(['status_id' => $assignedStatus]);
            $coachesIndex++;
        }

    }
}

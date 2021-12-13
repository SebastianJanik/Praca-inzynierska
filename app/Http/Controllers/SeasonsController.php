<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use App\Models\Statuses;
use App\Models\Team;
use App\Models\TeamLeagueSeasons;

class SeasonsController extends Controller
{
    public function index()
    {
        $seasons = Season::all();
        foreach ($seasons as $season)
            $season->status = Statuses::find($season->status_id);
        return view('seasons.index', compact('seasons'));
    }

    public function show($id)
    {
        $league_seasons = LeagueSeasons::where('season_id', $id)
            ->whereNotNull('league_id')->get();
        $leagues = League::whereIn('id', $league_seasons->pluck('league_id')->toArray())->get();
        $data = null;
        foreach ($league_seasons as $key=>$league_season)
            $data [] = [
                'league_season_id' => $league_season->id,
                'league' => $leagues[$key]
            ];
        return view('seasons.show', compact('data'));
    }
    public function create()
    {
        $modelStatuses = new Statuses();
        $season = Season::where('status_id', $modelStatuses->getStatus('incoming'))->get();
        if(!empty($season))
            return 'Exist incoming season';
        return view('seasons.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required|unique:seasons',
            ]
        );
        $modelStatusy = new Statuses();
        $data['status_id'] = $modelStatusy->getStatus("incoming");
        $season = Season::create($data);
        $leagues = League::all();
        $teams = Team::all();
        foreach ($leagues as $league) {
            LeagueSeasons::create(
                [
                    'season_id' => $season->id,
                    'league_id' => $league->id,
                    'status_id' => $modelStatusy->getStatus("timetable doesn't exist")
                ]
            );
        }
        $league_season = LeagueSeasons::create(
            [
                'season_id' => $season->id,
                'league_id' => null,
                'status_id' => $modelStatusy->getStatus("timetable doesn't exist")
            ]
        );
        foreach ($teams as $team){
            TeamLeagueSeasons::create(
                [
                    "team_id" => $team->id,
                    "league_season_id" => $league_season->id
                ]
            );
        }

        return view('seasons.store');
    }

    public function changeStatus()
    {
        $modelStatusy = new Statuses();
        $data = request()->validate(
            [
                "season_id" => "required",
                "submit" => "required"
            ]
        );
        $active_seasons = Season::where('status_id', $modelStatusy->getStatus('active'))->get();
        $incoming_seasons = Season::where('status_id', $modelStatusy->getStatus('incoming'))->get();
        $season = Season::find($data["season_id"]);
        switch ($data['submit']){
            case 'active' :
                if(count($active_seasons) >= 1){
                    $message = "Only one season can be active";
                    return redirect()->route('seasons.index')->with('message', $message);
                }
                $season->status_id = $modelStatusy->getStatus('active');
                break;
            case 'inactive' :
                $season->status_id = $modelStatusy->getStatus('inactive');
                break;
            case 'incoming' :
                if(count($incoming_seasons) >= 1){
                    $message = "Only one season can be incoming";
                    return redirect()->route('seasons.index')->with('message', $message);
                }
                $season->status_id = $modelStatusy->getStatus('incoming');
                break;
        }
        $season->save();
        return redirect()->route('seasons.index');
    }
}

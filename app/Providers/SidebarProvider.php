<?php

namespace App\Providers;

use App\Models\League;
use App\Models\LeagueSeasons;
use App\Models\Season;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $leagueSeasons = LeagueSeasons::where('status_id', '11')->get();
        $data = null;
        foreach ($leagueSeasons as $leagueSeason){
            $data [] = (object)array(
                'league_season_id' => $leagueSeason->id,
                'league' => League::find($leagueSeason->league_id)
            );
        }
        View::share(
            [
                'seasons' => Season::all(),
                'dataSidebar' => (object)$data,
                'archive' => Season::where('status_id', 2)->get()
            ]
        );
    }
}

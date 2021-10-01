<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamLeagueSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_league_seasons', function (Blueprint $table) {
            $table->foreignId('team_id')->constrained('teams')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('league_season_id')->constrained('league_seasons')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

            $table->primary(['team_id', 'league_season_id'], 'team_league_seasons_team_id_league_season_id_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_league_seasons');
    }
}

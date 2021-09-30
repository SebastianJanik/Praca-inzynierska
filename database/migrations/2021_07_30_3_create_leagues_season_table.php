<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaguesSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues_season', function (Blueprint $table) {
            $table->id();
            $table->foreignId('league_id')->constrained('leagues')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('season_id')->constrained('seasons')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues_season');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_users', function (Blueprint $table) {
            $table->foreignId('match_id')->nullable()->constrained('matches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('yellow_card');
            $table->boolean('red_card');
            $table->integer('goals');
            $table->integer('asists');
            $table->time('start_min');
            $table->time('end_min');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_users');
    }
}

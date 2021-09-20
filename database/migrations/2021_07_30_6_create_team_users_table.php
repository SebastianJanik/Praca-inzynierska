<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('team_users', function (Blueprint $table) {
//            $table->foreignId('team_id')->constrained('teams')->onUpdate('cascade')->onDelete('cascade');
//            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
//            $table->string('status');
//            $table->date('join_date')->nullable();
//            $table->date('left_date')->nullable();
//            $table->timestamps();
//        });

        Schema::create('team_users', function (Blueprint $table){
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            $table->date('join_date')->nullable();
            $table->date('left_date')->nullable();
            $table->timestamps();

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->primary(['team_id', 'user_id'], 'team_users_team_id_user_id_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->default('1')->constrained('statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('surname');
            $table->date('date_birth');
            $table->string('street');
            $table->integer('house_number');
            $table->integer('apartament_number')->nullable();
            $table->string('postal_code');
            $table->string('town');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('team_status')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

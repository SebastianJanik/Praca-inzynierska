<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Suspensions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suspensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->default('1')->constrained('statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('match_id')->nullable()->constrained('matches')->onUpdate('cascade')->onDelete('cascade');
            $table->string('reason');
            $table->unsignedInteger('length');
            $table->unsignedInteger('matches_left');

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
        Schema::dropIfExists('suspensions');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

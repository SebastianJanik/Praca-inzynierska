<?php

use App\Http\Controllers\API\TeamUsers\ApplyController;
use App\Http\Controllers\ApplyEndControler;
use App\Http\Controllers\LeaguesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TeamUsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/leagues/create', [LeaguesController::class, 'create'])->name('leagues_create');
Route::post('/leagues', [LeaguesController::class, 'store'])->name('leagues_store');
Route::get('/leagues', [LeaguesController::class, 'index'])->name('leagues_index');

Route::get('/teams/create', [TeamsController::class, 'create'])->name('teams_create');
Route::post('/teams', [TeamsController::class, 'store'])->name('teams_store');

Route::get('/seasons/create', [SeasonsController::class, 'create'])->name('seasons_create');
Route::post('/seasons', [SeasonsController::class, 'store'])->name('seasons_store');

Route::post('/players/create', [TeamUsersController::class, 'create'])->name('team_users_create');
Route::post('/players', [TeamUsersController::class, 'store'])->name('team_users_store');
Route::get('/players/apply', [TeamUsersController::class, 'apply'])->name('team_users_apply');

Route::apiResource('applies', ApplyController::class);
Route::apiResource('appliesend', ApplyEndControler::class);

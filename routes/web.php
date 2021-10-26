<?php

use App\Http\Controllers\Components\TimetableController;
use App\Http\Controllers\LeaguesController;
use App\Http\Controllers\LeagueSeasonsController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\MatchTeamsController;
use App\Http\Controllers\MatchUsersController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TeamUsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

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

Route::get('/users/players-index', [UsersController::class, 'indexPlayers'])->name('users.players_index');
Route::get('/users/players-show/{id}', [UsersController::class, 'showPlayers'])->name('users.players_show');

Route::get('/leagues/create', [LeaguesController::class, 'create'])->name('leagues.create');
Route::post('/leagues', [LeaguesController::class, 'store'])->name('leagues.store');

Route::get('/teams/create', [TeamsController::class, 'create'])->name('teams.create');
Route::get('/teams', [TeamsController::class, 'index'])->name('teams.index');
Route::get('/teams/{id}/edit', [TeamsController::class, 'edit'])->name('teams.edit');
Route::get('/teams/{id}/edit-assign', [TeamsController::class, 'editAssign'])->name('teams.editAssign');
Route::patch('/teams/{id}/update', [TeamsController::class, 'update'])->name('teams.update');
Route::patch('/teams/{id}/update-assign', [TeamsController::class, 'updateAssign'])->name('teams.updateAssign');
Route::post('/teams', [TeamsController::class, 'store'])->name('teams.store');

Route::get('/seasons/create', [SeasonsController::class, 'create'])->name('seasons.create');
Route::post('/seasons', [SeasonsController::class, 'store'])->name('seasons.store');
Route::get('/seasons', [SeasonsController::class, 'index'])->name('seasons.index');
Route::get('/seasons/{id}', [SeasonsController::class, 'show'])->name('seasons.show');

Route::get('/match-teams/create', [MatchTeamsController::class, 'create'])->name('match_teams.create');
Route::post('/match-teams', [MatchTeamsController::class, 'store'])->name('match_teams.store');

Route::get('/league-seasons', [LeagueSeasonsController::class, 'index'])->name('league_seasons.index');
Route::get('/league-seasons/{id}', [LeagueSeasonsController::class, 'show'])->name('league_seasons.show');

Route::get('/matches/{id}/edit', [MatchesController::class, 'edit'])->name('matches.edit');
Route::patch('/matches/{id}/update', [MatchesController::class, 'update'])->name('matches.update');

Route::get('/team-users/create', [TeamUsersController::class, 'create'])->name('team_users.create');
Route::post('/team-users', [TeamUsersController::class, 'store'])->name('team_users.store');
Route::post('/team-users/remove/{id}', [TeamUsersController::class, 'remove'])->name('team_users.remove');
Route::get('/team-users/accept-coach', [TeamUsersController::class, 'indexUsersAcceptCoach'])->name('team_users.accept_coach');
Route::get('/team-users/accept-admin', [TeamUsersController::class, 'indexUsersAcceptAdmin'])->name('team_users.accept_admin');
Route::put('/team-users/accept-coach', [TeamUsersController::class, 'storeUsersAcceptCoach'])->name('team_users.accept_coach_store');
Route::put('/team-users/accept-admin', [TeamUsersController::class, 'storeUsersAcceptAdmin'])->name('team_users.accept_admin_store');


//Route::match([''],'/team-users/test', [TeamUsersController::class, 'test'])->name('team_users_test'); get i post








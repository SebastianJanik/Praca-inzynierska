<?php

use App\Http\Controllers\LeaguesController;
use App\Http\Controllers\TeamsController;
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

Route::get('/teams/create', [TeamsController::class, 'create'])->name('teams_create');
Route::post('/teams', [TeamsController::class, 'store'])->name('teams_store');


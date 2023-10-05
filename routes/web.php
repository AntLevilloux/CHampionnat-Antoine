<?php

use App\Http\Controllers\ChampionnatController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::resource('championnat', ChampionnatController::class);

Route::resource('equipe', EquipeController::class);

Route::resource('joueur', JoueurController::class);

Route::get('/', function () {
    return redirect('championnat');
});

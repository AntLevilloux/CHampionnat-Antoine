<?php

use App\Http\Controllers\ChampionnatController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|-
*/

Route::get('/', function () {
    return redirect('register');
});

Route::resource('championnat', ChampionnatController::class);

Route::resource('equipe', EquipeController::class);

Route::resource('joueur', JoueurController::class);

Route::resource('match', MatchController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('locale', 'LocalizationController@getLang')->name('getlang');

Route::get('locale/{lang}', 'LocalizationController@setLang')->name('setlang');

require __DIR__.'/auth.php';

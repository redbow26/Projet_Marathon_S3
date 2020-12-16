<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/randomGames/{nb}',[\App\Http\Controllers\Jeux::class,'randomGames'])->name('randomGames')->middleware('auth');

Route::get('/enonce', function () {
    return view('enonce.index');
});

Route::resource('/jeux', 'App\Http\Controllers\Jeux');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/regle', [\App\Http\Controllers\RegleJeuController::class, 'index'])->name('regle.index');
Route::get('/regle/{id}', [\App\Http\Controllers\RegleJeuController::class, 'show'])->name('regle.show')->where('id','[0-9]+');

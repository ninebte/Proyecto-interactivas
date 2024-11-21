<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateUser;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\NarutoController;

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');




Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/pokemon', [PokemonController::class, 'search'])->name('pokemon.search');
Route::post('/pokemon/favorite', [PokemonController::class, 'addFavorite'])->name('pokemon.add_favorite');
Route::get('/pokemon/favorites', [PokemonController::class, 'favorites'])->name('pokemon.favorites');
Route::delete('/pokemon/favorites/{id}', [PokemonController::class, 'removeFavorite'])->name('pokemon.remove_favorite');

Route::get('/naruto/search', [NarutoController::class, 'search'])->name('naruto.search');
Route::get('/naruto/fetch', [NarutoController::class, 'fetchCharacters'])->name('naruto.fetch');
Route::post('/naruto/favorite', [NarutoController::class, 'addFavorite'])->name('naruto.favorite');
Route::get('/naruto/favorites', [NarutoController::class, 'favorites'])->name('naruto.favorites');
Route::delete('/naruto/favorites/{id}', [NarutoController::class, 'removeFavorite'])->name('naruto.remove_favorite');




Route::post('/logout', function (Illuminate\Http\Request $request) {
    $request->session()->forget('user_id'); // Elimina el ID de usuario de la sesión
    return redirect('/login'); // Redirige al login
})->name('logout');




// Ruta de prueba para el dashboard
Route::get('/', function () {
    return view('login');
});
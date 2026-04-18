<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RandomizeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth.session')->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/teams/{team}/points', [DashboardController::class, 'addPoints'])->name('teams.points');
    Route::post('/teams/{team}/points/remove', [DashboardController::class, 'removePoints'])->name('teams.points.remove');
    Route::get('/historico', [DashboardController::class, 'history'])->name('history');
    Route::get('/sorteio', [RandomizeController::class, 'index'])->name('randomize');
});

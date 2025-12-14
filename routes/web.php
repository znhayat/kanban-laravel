<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TascaController;
use App\Http\Controllers\PrioritatController;
use App\Http\Controllers\EstatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TascaController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tasques', TascaController::class);
    Route::resource('prioritats', PrioritatController::class);
    Route::resource('estats', EstatController::class);

});

require __DIR__.'/auth.php';

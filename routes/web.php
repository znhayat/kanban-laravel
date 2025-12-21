<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TascaController;
use App\Http\Controllers\PrioritatController;
use App\Http\Controllers\EstatController;
use App\Http\Controllers\UsuariController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('usuaris', UsuariController::class);

// Dashboard (autenticats i verificats)
Route::get('/dashboard', [TascaController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Usuari
    Route::get('/users/{id}/edit', [UsuariController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{id}', [UsuariController::class, 'update'])->name('users.update');

    // --- TASQUES ---
    // Tots poden veure l'index
    Route::get('/tasques', [TascaController::class, 'index'])->name('tasques.index');
    
    // Admin pot gestionar
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/tasques/create', [TascaController::class, 'create'])->name('tasques.create');
        Route::post('/tasques', [TascaController::class, 'store'])->name('tasques.store');
        Route::get('/tasques/{tasque}/edit', [TascaController::class, 'edit'])->name('tasques.edit');
        Route::put('/tasques/{tasque}', [TascaController::class, 'update'])->name('tasques.update');
        Route::delete('/tasques/{tasque}', [TascaController::class, 'destroy'])->name('tasques.destroy');
        
        // Drag & drop AJAX (només admin)
        Route::post('/tasques/{id}/update-estat', [TascaController::class, 'updateEstat'])
            ->name('tasques.updateEstat');
    });

    // --- PRIORITATS ---
    // Tots poden veure l'index
    Route::get('/prioritats', [PrioritatController::class, 'index'])->name('prioritats.index');
    
    // Admin pot gestionar
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/prioritats/create', [PrioritatController::class, 'create'])->name('prioritats.create');
        Route::post('/prioritats', [PrioritatController::class, 'store'])->name('prioritats.store');
        Route::get('/prioritats/{prioritat}/edit', [PrioritatController::class, 'edit'])->name('prioritats.edit');
        Route::put('/prioritats/{prioritat}', [PrioritatController::class, 'update'])->name('prioritats.update');
        Route::delete('/prioritats/{prioritat}', [PrioritatController::class, 'destroy'])->name('prioritats.destroy');
    });

    // --- ESTATS ---
    // Tots poden veure l'index
    Route::get('/estats', [EstatController::class, 'index'])->name('estats.index');
    
    // Admin pot gestionar
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/estats/create', [EstatController::class, 'create'])->name('estats.create');
        Route::post('/estats', [EstatController::class, 'store'])->name('estats.store');
        Route::get('/estats/{estat}/edit', [EstatController::class, 'edit'])->name('estats.edit');
        Route::put('/estats/{estat}', [EstatController::class, 'update'])->name('estats.update');
        Route::delete('/estats/{estat}', [EstatController::class, 'destroy'])->name('estats.destroy');
    });
});

require __DIR__.'/auth.php';
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariController;
use App\Http\Controllers\PrioritatController;
use App\Http\Controllers\TascaController;

use App\Models\Prioritat;

Route::resource('usuaris', UsuariController::class);
Route::resource('prioritats', PrioritatController::class);
Route::resource('tasques', TascaController::class);






Route::get('/', function () {
    return view('welcome');
});

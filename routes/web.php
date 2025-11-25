<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariController;
use App\Http\Controllers\PrioritatController;
use App\Models\Prioritat;

Route::resource('usuaris', UsuariController::class);
Route::resource('prioritats', PrioritatController::class);





Route::get('/', function () {
    return view('welcome');
});

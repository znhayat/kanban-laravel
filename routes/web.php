<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariController;


Route::resource('usuaris', UsuariController::class);



Route::get('/', function () {
    return view('welcome');
});

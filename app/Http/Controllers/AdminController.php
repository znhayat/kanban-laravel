<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Mètode per mostrar el perfil administrador
    public function index()
    {
        return view('admin.index'); // retorna la vista admin/index.blade.php
    }
}

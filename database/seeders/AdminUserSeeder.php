<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuari administrador
        User::create([
            'nom' => 'Administrador',
            'email' => 'admin@kanban.test',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
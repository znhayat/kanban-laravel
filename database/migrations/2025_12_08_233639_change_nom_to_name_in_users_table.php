<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Si tens columna 'nom', canvia-la a 'name'
            if (Schema::hasColumn('users', 'nom') && !Schema::hasColumn('users', 'name')) {
                $table->renameColumn('nom', 'name');
            }
            
            // Si no tens cap dels dos, crea 'name'
            if (!Schema::hasColumn('users', 'name') && !Schema::hasColumn('users', 'nom')) {
                $table->string('name')->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revertir el canvi si cal
            if (Schema::hasColumn('users', 'name') && !Schema::hasColumn('users', 'nom')) {
                $table->renameColumn('name', 'nom');
            }
        });
    }
};
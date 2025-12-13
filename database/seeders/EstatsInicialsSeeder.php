<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatsInicialsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('estats')->insert([
            ['nom' => 'ToDo', 'color' => '#93c5fd', 'ordre' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Doing', 'color' => '#fbbf24', 'ordre' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Done', 'color' => '#86efac', 'ordre' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prioritats')->insert([
            ['nom' => 'Alta', 'color' => '#ff0000'],
            ['nom' => 'Mitjana', 'color' => '#ffa500'],
            ['nom' => 'Baixa', 'color' => '#00ff00'],
        ]);

    }
}

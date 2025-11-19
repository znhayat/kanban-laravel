<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EstatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estats')->insert([
            ['nom' => 'ToDo'],
            ['nom' => 'Doing'],
            ['nom' => 'Done'],
        ]);
    }
}

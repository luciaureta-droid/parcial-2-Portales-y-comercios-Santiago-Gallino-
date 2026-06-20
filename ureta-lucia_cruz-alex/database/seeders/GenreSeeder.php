<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([

            [
                'id' => 1,
                'name' => 'Fantasy',
                'description' => 'Género literario que incluye elementos mágicos, mundos imaginarios y criaturas fantásticas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 2,
                'name' => 'Adventure',
                'description' => 'Relatos centrados en viajes, desafíos y experiencias emocionantes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 3,
                'name' => 'Magical Realism',
                'description' => 'Género que combina la realidad cotidiana con elementos mágicos o sobrenaturales.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 4,
                'name' => 'Philosophical Fiction',
                'description' => 'Narraciones que exploran ideas filosóficas, existenciales o reflexivas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 5,
                'name' => 'Classic Literature',
                'description' => 'Obras literarias reconocidas por su valor histórico, cultural y artístico.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
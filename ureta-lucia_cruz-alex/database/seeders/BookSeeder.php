<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Le indicamos a Laravel que guarde estos libros en tu tabla 'books'
        DB::table('books')->insert([
            [
                'title' => 'El Alquimista - Paulo Coelho',
                'price' => 12500,
                'cover' => 'alquimista.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cien Años de Soledad - Gabriel García Márquez',
                'price' => 18900,
                'cover' => 'soledad.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ficciones - Jorge Luis Borges',
                'price' => 14200,
                'cover' => 'ficciones.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'El Principito - Antoine de Saint-Exupéry',
                'price' => 8500,
                'cover' => 'principito.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        DB::table('book_genre')->insert([

            // El Alquimista
            ['book_fk' => 1, 'genre_fk' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['book_fk' => 1, 'genre_fk' => 4, 'created_at' => now(), 'updated_at' => now()],

            // Cien Años de Soledad
            ['book_fk' => 2, 'genre_fk' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['book_fk' => 2, 'genre_fk' => 5, 'created_at' => now(), 'updated_at' => now()],

            // Ficciones
            ['book_fk' => 3, 'genre_fk' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['book_fk' => 3, 'genre_fk' => 5, 'created_at' => now(), 'updated_at' => now()],

            // El Principito
            ['book_fk' => 4, 'genre_fk' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['book_fk' => 4, 'genre_fk' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['book_fk' => 4, 'genre_fk' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

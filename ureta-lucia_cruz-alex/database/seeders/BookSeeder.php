<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        

        DB::table('books')->insert([

            [
                'title' => 'El Alquimista',
                'author_fk' => 1,
                'price' => 1250,
                'publication_date' => '1988-01-01',
                'description' => 'Una novela sobre el destino y la búsqueda personal.',
                'cover' => null,
                'cover_description' => 'Portada del libro El Alquimista de Paulo Coelho',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Cien Años de Soledad',
                'author_fk' => 2,
                'price' => 1890,
                'publication_date' => '1967-05-30',
                'description' => 'Una obra maestra del realismo mágico latinoamericano.',
                'cover' => null,
                'cover_description' => 'Portada del libro Cien Años de Soledad de Gabriel García Márquez',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Ficciones',
                'author_fk' => 3,
                'price' => 1420,
                'publication_date' => '1944-01-01',
                'description' => 'Colección de cuentos filosóficos y fantásticos.',
                'cover' => null,
                'cover_description' => 'Portada del libro Ficciones de Jorge Luis Borges',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'El Principito',
                'author_fk' => 4,
                'price' => 2510,
                'publication_date' => '1943-04-06',
                'description' => 'Un clásico sobre la amistad, la inocencia y la vida.',
                'cover' => null,
                'cover_description' => 'Portada del libro El Principito de Antoine de Saint-Exupéry',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}

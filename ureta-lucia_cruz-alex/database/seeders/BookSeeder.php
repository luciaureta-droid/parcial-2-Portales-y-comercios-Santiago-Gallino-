<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Le indicamos a Laravel que guarde estos libros en tu tabla 'books'
        /* DB::table('books')->insert([
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
        ]); */



        DB::table('books')->insert([

            [
                'title' => 'El Alquimista',
                'price' => 12500,
                'publication_date' => '1988-01-01',
                'author' => 'Paulo Coelho',
                'description' => 'Una novela sobre el destino y la búsqueda personal.',
                'cover' => null,
                'cover_description' => 'Portada del libro El Alquimista de Paulo Coelho',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Cien Años de Soledad',
                'price' => 18900,
                'publication_date' => '1967-05-30',
                'author' => 'Gabriel García Márquez',
                'description' => 'Una obra maestra del realismo mágico latinoamericano.',
                'cover' => null,
                'cover_description' => 'Portada del libro Cien Años de Soledad de Gabriel García Márquez',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Ficciones',
                'price' => 14200,
                'publication_date' => '1944-01-01',
                'author' => 'Jorge Luis Borges',
                'description' => 'Colección de cuentos filosóficos y fantásticos.',
                'cover' => null,
                'cover_description' => 'Portada del libro Ficciones de Jorge Luis Borges',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'El Principito',
                'price' => 8500,
                'publication_date' => '1943-04-06',
                'author' => 'Antoine de Saint-Exupéry',
                'description' => 'Un clásico sobre la amistad, la inocencia y la vida.',
                'cover' => null,
                'cover_description' => 'Portada del libro El Principito de Antoine de Saint-Exupéry',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}

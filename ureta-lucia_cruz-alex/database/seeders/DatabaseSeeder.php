<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Acá podemos definir los seeders por defecto que el comando "db:seed" debe ejecutar, y en
        // qué orden debe hacerlo.
        $this->call([
            UserSeeder::class,      // Primero creamos los usuarios para la autenticación
            AuthorSeeder::class,    // Autores de los libros
            GenreSeeder::class,     // Géneros literarios
            BookSeeder::class,      // Catálogo de libros principales
            BookGenreSeeder::class, // Tabla intermedia de relaciones
        ]);
    }
}
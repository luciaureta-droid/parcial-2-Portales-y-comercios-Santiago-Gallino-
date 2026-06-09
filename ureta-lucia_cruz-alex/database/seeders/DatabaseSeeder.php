<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creamos el usuario Administrador real para el examen (datos.txt)
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@books.com',
            'password' => Hash::make('password123'), // Así queda encriptada en la base de datos
        ]);

        // Llamamos al seeder de libros que ya tenías configurado
        $this->call([
            BookSeeder::class,
        ]);
    }
}
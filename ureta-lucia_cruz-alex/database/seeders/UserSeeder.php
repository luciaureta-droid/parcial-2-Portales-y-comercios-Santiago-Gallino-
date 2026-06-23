<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Insertamos el usuario Administrador (el que tu middleware deja pasar)
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Profesor Admin',
            'email' => 'admin@books.com',
            // Noten que para generar el hash del password no estamos usando directamente
            // la función password_hash() ni bcrypt(), sino que usamos la façade Hash de Laravel.
            // El sistema de autenticación de Laravel verifica el password con la clase Hash.
            'password' => Hash::make('password123'), // <- CORREGIDO: Clave oficial del Admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Insertamos el usuario Cliente común (el que vas a usar para probar los mails)
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Juan Pérez (Cliente)',
            'email' => 'juan@gmail.com',
            'password' => Hash::make('123456'), // Clave oficial para el cliente que reserva
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('authors')->insert([

            [
                'id' => 1,
                'name' => 'Paulo Coelho',
                'nationality' => 'Brasileña',
                'birth_date' => '1947-08-24',
                'biography' => 'Paulo Coelho es un escritor brasileño reconocido internacionalmente. Es autor de El Alquimista, una de las novelas contemporáneas más leídas, vinculada a la búsqueda personal, los sueños y el destino.',
                'photo' => 'paulo_coelho.jpg',
                'photo_description' => 'Retrato de Paulo Coelho',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 2,
                'name' => 'Gabriel García Márquez',
                'nationality' => 'Colombiana',
                'birth_date' => '1927-03-06',
                'biography' => 'Gabriel García Márquez fue un escritor colombiano y Premio Nobel de Literatura. Es una de las figuras más importantes del realismo mágico y autor de Cien Años de Soledad.',
                'photo' => 'gabriel_garcia_marquez.jpg',
                'photo_description' => 'Retrato de Gabriel García Márquez',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 3,
                'name' => 'Jorge Luis Borges',
                'nationality' => 'Argentina',
                'birth_date' => '1899-08-24',
                'biography' => 'Jorge Luis Borges fue un escritor argentino reconocido por sus cuentos, ensayos y obras de carácter filosófico. Su literatura aborda temas como los laberintos, el tiempo, los espejos y el infinito.',
                'photo' => 'jorge_luis_borges.jpg',
                'photo_description' => 'Retrato de Jorge Luis Borges',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 4,
                'name' => 'Antoine de Saint-Exupéry',
                'nationality' => 'Francesa',
                'birth_date' => '1900-06-29',
                'biography' => 'Antoine de Saint-Exupéry fue un escritor, poeta y aviador francés. Es conocido principalmente por El Principito, una obra clásica que reflexiona sobre la amistad, la infancia y el sentido de la vida.',
                'photo' => 'antoine_saint_exupery.jpg',
                'photo_description' => 'Retrato de Antoine de Saint-Exupéry',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
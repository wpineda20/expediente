<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direction;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Direction::insert([
            [
                "id" => 1,
                "direction_name" => "Jefatura de Gabinete",
                "created_at" => now(),
            ],
            [
                "id" => 2,
                "direction_name" => "Dirección General Financiera Institucional",
                "created_at" => now(),
            ],
            [
                "id" => 3,
                "direction_name" => "Dirección General de Multiculturalidad",
                "created_at" => now(),
            ],
            [
                "id" => 4,
                "direction_name" => "Dirección General de Género y Diversidad",
                "created_at" => now(),
            ],
            [
                "id" => 5,
                "direction_name" => "Dirección General de Género y Diversidad",
                "created_at" => now(),
            ],
            [
                "id" => 6,
                "direction_name" => "Dirección General de Comunicaciones Institucionales",
                "created_at" => now(),
            ],
            [
                "id" => 7,
                "direction_name" => "Dirección General de Relaciones Internacionales y Cooperación",
                "created_at" => now(),
            ],
            [
                "id" => 8,
                "direction_name" => "Dirección General Ambiental",
                "created_at" => now(),
            ],
            [
                "id" => 9,
                "direction_name" => "Dirección General de Planificación y Desarrollo Institucional",
                "created_at" => now(),
            ],
            [
                "id" => 10,
                "direction_name" => "Dirección General de Proyectos de Inversión",
                "created_at" => now(),
            ],
            [
                "id" => 11,
                "direction_name" => "Dirección General de Auditoría Interna",
                "created_at" => now(),
            ],
            [
                "id" => 12,
                "direction_name" => "Dirección General de Administración",
                "created_at" => now(),
            ],
            [
                "id" => 13,
                "direction_name" => "Dirección Nacional de Artes",
                "created_at" => now(),
            ],
            [
                "id" => 14,
                "direction_name" => "Dirección Nacional de Formación de Artes",
                "created_at" => now(),
            ],
            [
                "id" => 15,
                "direction_name" => "Dirección Nacional de Casas de la Cultura y Parques Culturales",
                "created_at" => now(),
            ],
            [
                "id" => 16,
                "direction_name" => "Dirección Nacional de Bibliotecas, Archivo y Publicaciones",
                "created_at" => now(),
            ],
            [
                "id" => 17,
                "direction_name" => "Dirección Nacional de Museos y Salas de Exposición",
                "created_at" => now(),
            ],
            [
                "id" => 18,
                "direction_name" => "Dirección Nacional de Patrimonio Cultural",
                "created_at" => now(),
            ],
            // [
            //     "id" => 19,
            //     "direction_name" => "Compañía Nacional de Danza",
            //     "created_at" => now(),
            // ],
            // [
            //     "id" => 20,
            //     "direction_name" => "Ballet Folklórico Nacional",
            //     "created_at" => now(),
            // ],
            // [
            //     "id" => 21,
            //     "direction_name" => "Ballet Nacional de El Salvador",
            //     "created_at" => now(),
            // ],
            // [
            //     "id" => 22,
            //     "direction_name" => "Orquesta Sinfónica de El Salvador",
            //     "created_at" => now(),
            // ],
            // [
            //     "id" => 23,
            //     "direction_name" => "Coro Nacional de El Salvador",
            //     "created_at" => now(),
            // ],
            [
                "id" => 19,
                "direction_name" => "Dirección de Teatros Nacionales",
                "created_at" => now(),
            ],
            [
                "id" => 20,
                "direction_name" => "Dirección de Cine",
                "created_at" => now(),
            ],
            [
                "id" => 21,
                "direction_name" => "Dirección de Arte X",
                "created_at" => now(),
            ],
            [
                "id" => 22,
                "direction_name" => "Dirección de Parques Culturales",
                "created_at" => now(),
            ],
            [
                "id" => 23,
                "direction_name" => "Dirección de Casas de la Cultura",
                "created_at" => now(),
            ],
            [
                "id" => 24,
                "direction_name" => "Dirección de Casas de la Cultura",
                "created_at" => now(),
            ],
            [
                "id" => 25,
                "direction_name" => "Dirección de Publicaciones e Impresos",
                "created_at" => now(),
            ],
            [
                "id" => 26,
                "direction_name" => "Dirección de Arqueología",
                "created_at" => now(),
            ],
            [
                "id" => 27,
                "direction_name" => "Dirección de Bienes Culturales Inmuebles y Gestión Urbana",
                "created_at" => now(),
            ],
            [
                "id" => 28,
                "direction_name" => "Dirección de Antropología Cultural",
                "created_at" => now(),
            ],
            [
                "id" => 29,
                "direction_name" => "Dirección de Registro de Bienes Culturales",
                "created_at" => now(),
            ],
            [
                "id" => 30,
                "direction_name" => "Dirección de Conservación de Bienes Culturales Inmuebles",
                "created_at" => now(),
            ],
        ]);
    }
}

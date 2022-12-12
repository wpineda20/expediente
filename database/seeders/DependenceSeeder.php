<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dependence;

class DependenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dependence::insert([
            [
                "id" => 1,
                "unit_name" => "Unidad de Talento Humano",
                "direction_id" => 12,
                "created_at" => now(),
            ],
            [
                "id" => 2,
                "unit_name" => "Unidad de Informática y Sistemas",
                "direction_id" => 12,
                "created_at" => now(),
            ],
            [
                "id" => 3,
                "unit_name" => "Unidad de Adquisiciones y Contrataciones Institucional",
                "direction_id" => 12,
                "created_at" => now(),
            ],
            [
                "id" => 4,
                "unit_name" => "Unidad de Unidad de Mantenimiento",
                "direction_id" => 12,
                "created_at" => now(),
            ],
            [
                "id" => 5,
                "unit_name" => "Unidad de Gestión Documental y Archivos",
                "direction_id" => 12,
                "created_at" => now(),
            ],
            [
                "id" => 6,
                "unit_name" => "Unidad de Logística",
                "direction_id" => 12,
                "created_at" => now(),
            ],
            [
                "id" => 7,
                "unit_name" => "Unidad de Acceso a la Información Pública",
                "direction_id" => 12,
                "created_at" => now(),
            ],
            [
                "id" => 8,
                "unit_name" => "Unidad de Activo Fijo",
                "direction_id" => 12,
                "created_at" => now(),
            ],
            [
                "id" => 9,
                "unit_name" => "Compañía Nacional de Danza",
                "direction_id" => 13,
                "created_at" => now(),
            ],
            [
                "id" => 10,
                "unit_name" => "Ballet Folklórico Nacional",
                "direction_id" => 13,
                "created_at" => now(),
            ],
            [
                "id" => 11,
                "unit_name" => "Ballet Nacional de El Salvador",
                "direction_id" => 13,
                "created_at" => now(),
            ],
            [
                "id" => 12,
                "unit_name" => "Orquesta Sinfónica de El Salvador",
                "direction_id" => 13,
                "created_at" => now(),
            ],
            [
                "id" => 13,
                "unit_name" => "Coro Nacional de El Salvador",
                "direction_id" => 13,
                "created_at" => now(),
            ],
            [
                "id" => 14,
                "unit_name" => "Teatro Nacional de San Salvador",
                "direction_id" => 19,
                "created_at" => now(),
            ],
            [
                "id" => 15,
                "unit_name" => "Teatro Presidente",
                "direction_id" => 19,
                "created_at" => now(),
            ],
            [
                "id" => 16,
                "unit_name" => "Teatro Nacional de Santa Ana",
                "direction_id" => 19,
                "created_at" => now(),
            ],
            [
                "id" => 17,
                "unit_name" => "Teatro Nacional Francisco Gavidia de San Miguel",
                "direction_id" => 19,
                "created_at" => now(),
            ],
            [
                "id" => 18,
                "unit_name" => "Proyectos y Producción Audiovisual",
                "direction_id" => 20,
                "created_at" => now(),
            ],
            [
                "id" => 19,
                "unit_name" => "Centro Nacional de Artes (CENAR)",
                "direction_id" => 14,
                "created_at" => now(),
            ],
            [
                "id" => 20,
                "unit_name" => "Escuela Nacional de Danza Morena Celarié",
                "direction_id" => 14,
                "created_at" => now(),
            ],
            [
                "id" => 21,
                "unit_name" => "Sistemas de Coros y Orquestas Juveniles",
                "direction_id" => 14,
                "created_at" => now(),
            ],
            [
                "id" => 22,
                "unit_name" => "Parque Saburo Hirao",
                "direction_id" => 22,
                "created_at" => now(),
            ],
            [
                "id" => 23,
                "unit_name" => "Parque Infantil de Diversiones",
                "direction_id" => 22,
                "created_at" => now(),
            ],
            [
                "id" => 24,
                "unit_name" => "Casas de la Cultura Regional de Oriente",
                "direction_id" => 23,
                "created_at" => now(),
            ],
            [
                "id" => 25,
                "unit_name" => "Casas de la Cultura Regional de Occidente",
                "direction_id" => 23,
                "created_at" => now(),
            ],
            [
                "id" => 26,
                "unit_name" => "Casas de la Cultura Regional Central",
                "direction_id" => 23,
                "created_at" => now(),
            ],
            [
                "id" => 27,
                "unit_name" => "Casas de la Cultura Regional Paracentral",
                "direction_id" => 23,
                "created_at" => now(),
            ],
            [
                "id" => 28,
                "unit_name" => "Red de Bibliotecas",
                "direction_id" => 16,
                "created_at" => now(),
            ],
            [
                "id" => 29,
                "unit_name" => "Biblioteca Nacional de El Salvador Francisco Gavidia",
                "direction_id" => 16,
                "created_at" => now(),
            ],
            [
                "id" => 30,
                "unit_name" => "Archivo General de la Nación",
                "direction_id" => 16,
                "created_at" => now(),
            ],
            [
                "id" => 31,
                "unit_name" => "Museo Nacional de Antropología Dr. David J. Guzmán",
                "direction_id" => 17,
                "created_at" => now(),
            ],
            [
                "id" => 32,
                "unit_name" => "Museo de Historia Natural de El Salvador",
                "direction_id" => 17,
                "created_at" => now(),
            ],
            [
                "id" => 33,
                "unit_name" => "Museo Regional de Occidente",
                "direction_id" => 17,
                "created_at" => now(),
            ],
            [
                "id" => 34,
                "unit_name" => "Museo Regional de Oriente",
                "direction_id" => 17,
                "created_at" => now(),
            ],
            [
                "id" => 35,
                "unit_name" => "Sala Nacional de Exposiciones Salarrué",
                "direction_id" => 17,
                "created_at" => now(),
            ],
            [
                "id" => 36,
                "unit_name" => "Sala de Exposiciones San Jacinto",
                "direction_id" => 17,
                "created_at" => now(),
            ],
            [
                "id" => 37,
                "unit_name" => "Unidad de Inspección y Prospección Arqueológica",
                "direction_id" => 25,
                "created_at" => now(),
            ],
            [
                "id" => 38,
                "unit_name" => "Unidad de Evaluación e Investigaciones Arqueológicas",
                "direction_id" => 25,
                "created_at" => now(),
            ],
            [
                "id" => 39,
                "unit_name" => "Unidad de Conservación de Sitios y Parques Arqueológicos",
                "direction_id" => 25,
                "created_at" => now(),
            ],
            [
                "id" => 40,
                "unit_name" => "Unidad de Inspecciones y Autorizaciones",
                "direction_id" => 26,
                "created_at" => now(),
            ],
            [
                "id" => 41,
                "unit_name" => "Unidad de Conservación y Restauración de Bienes Culturales Inmuebles",
                "direction_id" => 26,
                "created_at" => now(),
            ],
            [
                "id" => 42,
                "unit_name" => "Unidad de Protección e Inventarios de Bienes Culturales Inmuebles",
                "direction_id" => 26,
                "created_at" => now(),
            ],
            [
                "id" => 43,
                "unit_name" => "Unidad de Educación y Divulgación",
                "direction_id" => 27,
                "created_at" => now(),
            ],
            [
                "id" => 44,
                "unit_name" => "Unidad de Inspección, Investigación y Valoración",
                "direction_id" => 27,
                "created_at" => now(),
            ],
            [
                "id" => 45,
                "unit_name" => "Unidad de Registro de Bienes Culturales",
                "direction_id" => 28,
                "created_at" => now(),
            ],
            [
                "id" => 46,
                "unit_name" => "Unidad de Gestión de Inventarios de Bienes Culturales Muebles",
                "direction_id" => 28,
                "created_at" => now(),
            ],
            [
                "id" => 47,
                "unit_name" => "Unidad de Control de Colecciones Nacionales",
                "direction_id" => 28,
                "created_at" => now(),
            ],
            [
                "id" => 48,
                "unit_name" => "Unidad de Prevención de Tráfico Ilícito de Bienes Culturales",
                "direction_id" => 28,
                "created_at" => now(),
            ],
            [
                "id" => 49,
                "unit_name" => "Laboratorio Taller de Conservación de Bienes Culturales Muebles",
                "direction_id" => 29,
                "created_at" => now(),
            ],
            [
                "id" => 50,
                "unit_name" => "Parque Arqueológico Joya de Cerén",
                "direction_id" => 18,
                "created_at" => now(),
            ],
        ]);
    }
}

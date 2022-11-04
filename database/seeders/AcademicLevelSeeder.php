<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcademicLevel;

class AcademicLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AcademicLevel::insert([
            [
                "id" => 1,
                "level_name" => "Tercer ciclo",
            ],
            [
                "id" => 2,
                "level_name" => "Bachillerato",
            ],
            [
                "id" => 3,
                "level_name" => "Universitario",
            ],
            [
                "id" => 4,
                "level_name" => "Diplomado",
            ],
            [
                "id" => 5,
                "level_name" => "Maestría",
            ],
            [
                "id" => 6,
                "level_name" => "Doctorado",
            ],
            [
                "id" => 7,
                "level_name" => "Capacitaciones",
            ],
        ]);
    }
}

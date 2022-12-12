<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kinship;

class KinshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Kinship::insert([
            [
                "id" => 1,
                "kinship_name" => "Hijo/a",
                "created_at" => now(),

            ],
            [
                "id" => 2,
                "kinship_name" => "Padre",
                "created_at" => now(),

            ],
            [
                "id" => 3,
                "kinship_name" => "Madre",
                "created_at" => now(),

            ],
            [
                "id" => 4,
                "kinship_name" => "Hermano/a",
                "created_at" => now(),

            ],
            [
                "id" => 5,
                "kinship_name" => "Cónyuge",
                "created_at" => now(),

            ],
            [
                "id" => 6,
                "kinship_name" => "Tío/a",
                "created_at" => now(),

            ],
            [
                "id" => 7,
                "kinship_name" => "Sobrino/a",
                "created_at" => now(),

            ],
             [
                "id" => 8,
                "kinship_name" => "Primo/a",
                "created_at" => now(),

            ],
            [
                "id" => 9,
                "kinship_name" => "Abuelo/a",
                "created_at" => now(),

            ],
            [
                "id" => 10,
                "kinship_name" => "Nieto/a",
                "created_at" => now(),

            ],
        ]);
    }
}

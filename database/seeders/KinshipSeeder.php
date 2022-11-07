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
                "kinship_name" => "Hermano/a",
                "created_at" => now(),

            ],
            [
                "id" => 2,
                "kinship_name" => "Primo/a",
                "created_at" => now(),

            ],
        ]);
    }
}

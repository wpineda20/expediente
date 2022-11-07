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
                "direction_name" => "Dirección de Informática",
                "created_at" => now(),

            ],
        ]);
    }
}

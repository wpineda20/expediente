<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Unit::insert([
            [
                "id" => 1,
                "unit_name" => "Unidad de Informática",
                "created_at" => now(),

            ],
        ]);
    }
}

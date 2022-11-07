<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profession::insert([
            [
                "id" => 1,
                "profession_name" => "Programador/a",
                "created_at" => now(),

            ],
        ]);
    }
}

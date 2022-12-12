<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeStatus;

class EmployeeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeStatus::insert([
            [
                "id" => 1,
                "status_name" => "Registrado",
                "created_at" => now(),

            ],
            [
                "id" => 2,
                "status_name" => "Digitado",
                "created_at" => now(),
            ],
            [
                "id" => 3,
                "status_name" => "Finalizado",
                "created_at" => now(),
            ],
        ]);
    }
}

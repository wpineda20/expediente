<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subdirection;

class SubdirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Subdirection::insert([
            [
                "id" => 1,
                "subdirection_name" => "Subdirección de Informática",
                "created_at" => now(),

            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FamilyStatus;

class FamilyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FamilyStatus::insert([
            [
                "id" => 1,
                "family_status_name" => "S",
                "created_at" => now(),

            ],
            [
                "id" => 2,
                "family_status_name" => "C",
                "created_at" => now(),
            ],
            [
                "id" => 3,
                "family_status_name" => "A",
                "created_at" => now(),
            ],
            [
                "id" => 4,
                "family_status_name" => "V",
                "created_at" => now(),
            ],
        ]);
    }
}

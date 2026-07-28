<?php

namespace Database\Seeders;

use App\Models\Administrateurs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministrateursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrateurs::factory()->count(3)->create();
    }
}

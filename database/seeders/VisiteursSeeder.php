<?php

namespace Database\Seeders;

use App\Models\Visiteurs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisiteursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Visiteurs::factory()->count(25)->create();
    }
}

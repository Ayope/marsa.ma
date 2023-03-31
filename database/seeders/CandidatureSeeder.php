<?php

namespace Database\Seeders;

use App\Models\Candidature;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CandidatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidature::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\FishingLiscence;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FishingLiscenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FishingLiscence::factory()->count(10)->create();
    }
}

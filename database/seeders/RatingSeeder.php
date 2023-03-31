<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::factory()->count(10)->create();
    }
}

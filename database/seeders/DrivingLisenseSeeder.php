<?php

namespace Database\Seeders;

use App\Models\DrivingLisense;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DrivingLisenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DrivingLisense::factory()->count(10)->create();
    }
}

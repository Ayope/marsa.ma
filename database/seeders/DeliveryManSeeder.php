<?php

namespace Database\Seeders;

use App\Models\DeliveryMan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeliveryManSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryMan::factory()->count(10)->create();
    }
}

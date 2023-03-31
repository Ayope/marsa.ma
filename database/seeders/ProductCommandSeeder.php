<?php

namespace Database\Seeders;

use App\Models\ProductCommand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCommandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCommand::factory()->count(10)->create();
    }
}

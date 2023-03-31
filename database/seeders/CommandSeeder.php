<?php

namespace Database\Seeders;

use App\Models\Command;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Command::factory()->count(10)->create();
    }
}

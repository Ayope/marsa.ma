<?php

namespace Database\Seeders;

use App\Models\PaymentInfo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentInfo::factory()->count(10)->create();
    }
}

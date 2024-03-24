<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VehicleSeeder::class,
            DrivingLisenseSeeder::class,
            DeliveryManSeeder::class,
            JobOfferSeeder::class,
            ProductSeeder::class,
            CandidatureSeeder::class,
            CommandSeeder::class,
            FishingLiscenceSeeder::class,
            PaymentInfoSeeder::class,
            ProductCommandSeeder::class,
            RatingSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);
    }
}

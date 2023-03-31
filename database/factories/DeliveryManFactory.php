<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryMan>
 */
class DeliveryManFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'max_deliveries_in_day' => $this->faker->numberBetween(1, 10),
            'delivery_man_id' => $this->faker->numberBetween(User::min('id'),User::max('id')), // where user role is delivery man
            'fisher_id' => $this->faker->numberBetween(User::min('id'),User::max('id')), // where user role is fisher
            'vehicle_id' => $this->faker->numberBetween(Vehicle::min('id'),Vehicle::max('id'))
        ];
    }
}

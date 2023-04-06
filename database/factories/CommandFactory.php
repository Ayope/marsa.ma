<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Command>
 */
class CommandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['pending', 'processing', 'delivered']),
            'payment_method' => $this->faker->randomElement(['cash on delivery', 'online']),
            'delivery_man_id' => $this->faker->numberBetween(User::min('id'),User::max('id')), // where role is delivery man
            'client_id' => $this->faker->numberBetween(User::min('id'),User::max('id')) // where role is client
        ];
    }
}

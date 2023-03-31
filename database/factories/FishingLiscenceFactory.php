<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FishingLiscence>
 */
class FishingLiscenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'license_number' => $this->faker->unique()->numerify('L###'),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'issue_date' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'type' => $this->faker->randomElement(['Freshwater', 'Saltwater']),
            'issuing_authority' => $this->faker->company,
            'fisher_id' => $this->faker->numberBetween(User::min('id'),User::max('id')),
            'document' => $this->faker->imageUrl,
            'notes' => $this->faker->sentence,
        ];
    }
}

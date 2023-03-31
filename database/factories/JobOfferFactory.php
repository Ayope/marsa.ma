<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOffer>
 */
class JobOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number_of_places' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->sentence(),
            'salary' => $this->faker->randomFloat(2, 1000, 5000),
            'deliveries_per_day' => $this->faker->numberBetween(1, 10),
            'vehicle_required' => $this->faker->sentence(),
            'fisher_id' => $this->faker->numberBetween(User::min('id'),User::max('id')),
        ];
    }
}

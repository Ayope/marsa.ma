<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DrivingLisense>
 */
class DrivingLisenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'license_number' => $this->faker->unique()->numberBetween(100000, 999999),
            'issue_date' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+10 years'),
            'issuing_place' => $this->faker->city,
            'class' => $this->faker->randomElement(['A', 'B', 'C']),
            'document' =>  $this->faker->imageUrl,
            'notes' => $this->faker->sentence,
            'delivery_man_id' =>  $this->faker->numberBetween(User::min('id'),User::max('id')),
        ];
    }
}

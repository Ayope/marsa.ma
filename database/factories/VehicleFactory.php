<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registration_matricule' => $this->faker->bothify('??? ###'),
            'make' => $this->faker->word(),
            'model' => $this->faker->word(),
            'capacity' => $this->faker->numberBetween(1, 10),
            'photo' => $this->faker->imageUrl(640, 480, 'transport'),
            'type' => $this->faker->randomElement(['car', 'motorcycle', 'truck']),
            'insurance' => $this->faker->randomElement(['valid', 'expired']),
            'delivery_man_id' => $this->faker->numberBetween(User::min('id'),User::max('id')),
        ];
    }
}

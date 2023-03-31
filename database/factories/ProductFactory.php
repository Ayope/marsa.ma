<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'fish_type' => $this->faker->word,
            'photo' => $this->faker->imageUrl,
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(1, 1000),
            'date_of_fishing' => $this->faker->date,
            'description' => $this->faker->paragraph,
            'fisher_id' => $this->faker->numberBetween(User::min('id'),User::max('id')) // where role is fisher
        ];
    }
}

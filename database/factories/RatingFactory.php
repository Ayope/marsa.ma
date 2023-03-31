<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ratings' => $this->faker->numberBetween(1, 5),
            'review' => $this->faker->paragraph,
            'client_id' => $this->faker->numberBetween(User::min('id'),User::max('id')),
            'product_id' => $this->faker->numberBetween(Product::min('id'),Product::max('id'))
        ];
    }
}

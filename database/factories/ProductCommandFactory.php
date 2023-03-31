<?php

namespace Database\Factories;

use App\Models\Command;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCommand>
 */
class ProductCommandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'command_id' => $this->faker->numberBetween(Command::min('id'),Command::max('id')),
            'product_id' => $this->faker->numberBetween(Product::min('id'),Product::max('id')),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}

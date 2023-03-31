<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentInfo>
 */
class PaymentInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => $this->faker->numberBetween(User::min('id'),User::max('id')),
            'card_number' => $this->faker->creditCardNumber,
            'security_code' => $this->faker->randomNumber(3),
            'expiration_month' => $this->faker->numberBetween(1, 12),
            'expiration_year' => $this->faker->numberBetween(2023, 2033),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\JobOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidature>
 */
class CandidatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_offer_id' => $this->faker->numberBetween(JobOffer::min('id'),JobOffer::max('id')),
            'fisher_id' => $this->faker->numberBetween(User::min('id'),User::max('id')),
            'candidate_first_name' => $this->faker->firstName,
            'candidate_last_name' => $this->faker->lastName,
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => fake()->randomElement([1, 2]),
            'uuid' => fake()->uuid(),
            'name' => fake()->name(),
            'gender' => fake()->randomElement([1, 2]),
            'email' => fake()->unique()->safeEmail(),
            'icno' => fake()->numerify('############'),
            'phone_no' => fake()->numerify(fake()->randomElement(['01########', '01#########'])),
            'coop_id' => fake()->randomElement([1, 2]),
            'email_verified_at' => now(),
            'password' => bcrypt('Csc@1234'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

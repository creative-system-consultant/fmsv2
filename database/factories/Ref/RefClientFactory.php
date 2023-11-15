<?php

namespace Database\Factories\Ref;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ref\RefClient>
 */
class RefClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'name' => fake()->company(),
            'name2' => fake()->companySuffix(),
            'type_id' => fake()->randomElement([1, 2]),
            'reg_num' => fake()->numerify('##########-CSC'),
            'description' => fake()->paragraph,
            'address_id' => fake()->randomElement([1, 2]),
            'status' => 1,
            'logo_path' => 'img/logo.png',
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM'
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Famille>
 */
class FamilleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomfam' => fake()->lastName(),
            'matfam' => fake()->numerify('HUMFAM-######'),
            'adrfam' => fake()->address(),
            'vilfam' => fake()->city(),
            'payfam' => fake()->country(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membre>
 */
class MembreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fammile_id' => fake()->numberBetween(1, 98),
            'qualite_id' => fake()->numberBetween(1, 3),
            'formule_id' => fake()->numberBetween(1, 2),
            'nommem' =>     fake()->name(),
            'matmem' =>     fake()->numerify('HUMEM-######'),
            'datnai' =>     fake()->dateTimeBetween(),
            'sexmem' =>     fake()->numberBetween(1, 2),
            'agemem' =>     fake()->numberBetween(25,70),
            'commem' =>     fake()->sentence(),
        ];
    }
}

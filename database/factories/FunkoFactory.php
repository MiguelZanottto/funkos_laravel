<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funko>
 */
class FunkoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'precio' => fake()->numberBetween(1, 100),
            'cantidad' => fake()->numberBetween(1, 100),
            'imagen' => 'https://static.vecteezy.com/system/resources/previews/005/337/799/non_2x/icon-image-not-found-free-vector.jpg',
            'categoria_id' => fake()->numberBetween(1,5),
            'isDeleted' => false,
        ];
    }
}

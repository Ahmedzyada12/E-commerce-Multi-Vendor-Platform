<?php

namespace Database\Factories;

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
            'name' => $this->faker->word,
            'category_id' =>1, // Assume you have categories seeded
            'price' => $this->faker->numberBetween(100, 1000),
            'amount' => $this->faker->numberBetween(1, 100),
            'inches' => $this->faker->randomFloat(1, 10, 20),
            'description' => $this->faker->sentence,
            
        ];
    }
}
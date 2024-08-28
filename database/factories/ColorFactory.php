<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ColorFactory extends Factory
{
    protected $model = Color::class;

    public function definition()
    {
        $faker = new Faker();
        $faker->unique($reset = true, $maxRetries = 20000);

        return [
            'name' => $this->faker->unique()->colorName,
            'color' => $this->faker->unique()->hexColor,
        ];
    }
}
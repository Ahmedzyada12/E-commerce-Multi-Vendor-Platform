<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        $faker = new Faker();
        $faker->unique($reset = true, $maxRetries = 20000);

        return [
            'name' => $this->faker->unique()->word,
        ];
    }
}
<?php

namespace Database\Factories;

use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

class SizeFactory extends Factory
{
    protected $model = Size::class;

    public function definition()
    {
        $faker = new Faker();
        $faker->unique($reset = true, $maxRetries = 20000);
        
      
        return [
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
        ];
    }
}
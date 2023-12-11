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
            'title' => $this->faker->name,
            'price' => $this->faker->randomNumber(4, false),
            'availability' => $this->faker->text(10),
            'delivery' => $this->faker->text(10),
            'image' => $this->faker->imageUrl(),
            'content' => $this->faker->text
        ];
    }
}

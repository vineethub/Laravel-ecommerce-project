<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
    return [
        'name' => fake()->word(),
        'description' => fake()->sentence(),
        'price' => fake()->randomFloat(2, 10, 500),
        // 'stock_quantity' => fake()->numberBetween(1, 100),
    ];
}
}

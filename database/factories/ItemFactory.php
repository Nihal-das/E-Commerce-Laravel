<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'item_name' => fake()->name(),
            'user_id' => User::factory(),
            'description' => fake()->address(),
            'price' => fake()->numberBetween(120, 500),
            'stock_quantity' => fake()->numberBetween(100,500),
            'status' => fake()->boolean(),
            'image_path' => fake()->name(),

        ];
    }
}

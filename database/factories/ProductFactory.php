<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

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
            'user_id' => $this->faker->numberBetween(1, 2),
            'store_id' => $this->faker->numberBetween(1, 2),
            'category_id' => $this->faker->numberBetween(1, 2),
            'name' => $this->faker->word(),
            'description' => $this->faker->optional()->sentence(10),
            'price' => $this->faker->randomFloat(2, 1, 1000), // between 1.00 and 1000.00
            'quantity' => $this->faker->numberBetween(0, 500),
            'product_code' => $this->faker->unique()->bothify('??-#####'),
        ];
    }
}

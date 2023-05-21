<?php

namespace Database\Factories;

use App\Models\User;
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
            'title' => $this->faker->words(4, true),
            'price' => $this->faker->numberBetween(500, 2000),
            'user_id' => function(){
                return User::factory()->create()->id;
            },
            'live' => false,
            'description' => $this->faker->paragraphs(4, true),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = fake()->sentence();
        $slug = Str::slug($name);
        $image = '643133f621493.png';

        return [
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'price' => fake()->unique()->numberBetween(100000,9999999),
            'deleted_at' => null
        ];
    }
}

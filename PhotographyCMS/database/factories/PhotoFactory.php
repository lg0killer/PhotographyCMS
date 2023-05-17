<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image = fake()->imageUrl();
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'image' => $image,
            'thumbnail' => $image,
            'alt_text' => fake()->text(),
            'slug' => fake()->slug(),
            'category' => fake()->word(),
            'tags' => fake()->word(),
            'location' => fake()->word(),
            'camera' => fake()->word(),
            'lens' => fake()->word(),
            'focal_length' => fake()->word(),
            'shutter_speed' => fake()->word(),
            'aperture' => fake()->word(),
            'iso' => fake()->word(),
            'taken_at' => fake()->word(),
            'published' => fake()->boolean(),
            'featured' => fake()->boolean(),
            'status' => fake()->word(),
        ];
    }
}

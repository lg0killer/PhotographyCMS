<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

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
        // $image = fake()->imageUrl();
        $image = fake()->image();
        $image_file = new File($image);
        //$disk = config('filesystems.public');
        $stored_image = Storage::disk('public')->putFile('photos', $image_file);
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'image' => Storage::url($stored_image),
            'image_path' => $stored_image,
            'submitted_at' => fake()->date(),
            'thumbnail' => Storage::url($stored_image),
            'alt_text' => fake()->text(),
            'slug' => fake()->slug(),
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
            'category_id' => fake()->numberBetween(1, 5),
            'theme_id' => fake()->numberBetween(1, 3),
        ];
    }
}

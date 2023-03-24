<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        $user_id = User::all()->random()->id;
        return [
            'path' => fake()->imageUrl(),
            'name' => fake()->name(),
            'description' => fake()->paragraphs(2,true),
            'owned_by' => $user_id,
            'uploaded_by' => $user_id,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
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
            'link' => $this->faker->url,
            'logo' => $this->faker->imageUrl(),
            'type' => $this->faker->randomElement(['main','global','individual','organization','other']),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}

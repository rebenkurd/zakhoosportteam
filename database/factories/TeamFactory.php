<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Zakho FC",
            'logo' => $this->faker->imageUrl(),
            'stadium' => "Zakho Stadium",
            'city' => "Zakho",
            'country' => "Iraq",
            'website' => $this->faker->url,
            'founded' => $this->faker->date(),
            'president' => $this->faker->name,
            'coach' => $this->faker->name,
            'captain' => $this->faker->name,
            'vice_captain' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'facebook' => $this->faker->url,
            'twitter' => $this->faker->url,
            'instagram' => $this->faker->url,
            'youtube' => $this->faker->url,
            'status' => "active",
        ];
    }
}

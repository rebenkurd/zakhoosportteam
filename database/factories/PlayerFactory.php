<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'age' => $this->faker->date(),
            'national' => $this->faker->country,
            'position' => $this->faker->randomElement(['Goalkeeper', 'Defender', 'Midfielder', 'Forward']),
            'team_id' => 1,
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
            'height' => $this->faker->randomFloat(2, 1.5, 2.2),
            'weight' => $this->faker->randomFloat(2, 50, 100),
            'foot' => $this->faker->randomElement(['Right', 'Left']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'joined' => $this->faker->date(),
            'contract_expires' => $this->faker->date(),
            'shirt_number' => $this->faker->numberBetween(1, 99),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}

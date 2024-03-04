<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTimeThisYear,
            'location' => $this->faker->address,
            'category_id' => $this->faker->numberBetween(1, 10),
            'number_attendees' => $this->faker->numberBetween(1, 1000),
        ];
    }
}

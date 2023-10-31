<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\history>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'license'     => fake()->regexify('[A-Z]{3}-\d{3}'),
            'search_time' => fake()->dateTimeBetween(2021, 2023),
        ];
    }
}

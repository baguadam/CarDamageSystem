<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $models = [
            "KIA",
            "Huyndai",
            "Honda",
            "Chevrolet",
            "Opel",
            "Mercedes",
            "BMW",
            "Audi",
            "Ford",
            "Porsche",
            "Fiat",
            "Nissan"
        ];

        return [
            'license' => fake()->regexify('[A-Z]{3}-\d{3}'),
            'model'   => fake()->randomElement($models),
            'type'    => fake()->text(8),
            'year'    => fake()->dateTimeBetween('',''),
        ];
    }
}

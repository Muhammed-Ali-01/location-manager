<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'      => fake()->name,
            'longitude' => fake()->numberBetween(-180, 180),
            'latitude'  => fake()->numberBetween(-90, 90),
            'color'     => fake()->hexColor(),
        ];
    }
}

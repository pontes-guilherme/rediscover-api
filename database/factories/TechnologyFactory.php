<?php

namespace Database\Factories;

use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Technology>
 */
class TechnologyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}

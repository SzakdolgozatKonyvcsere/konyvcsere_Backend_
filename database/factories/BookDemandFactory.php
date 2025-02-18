<?php

namespace Database\Factories;

use App\Models\Publisher;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookDemand>
 */
class BookDemandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => User::all()->random()->id, // Hozzárendeli egy véletlenszerű User-hez
            'publisher' => Publisher::all()->random()->publisher_id,
            'work' => Work::all()->random()->work_id,
            'language' => fake()->languageCode(),
            'min_publication_year' => fake()->year(),
            'max_publication_year' => fake()->year(),
            'demand_status' => rand(0,2)
        ];
    }
}

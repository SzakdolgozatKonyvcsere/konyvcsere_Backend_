<?php

namespace Database\Factories;

use App\Models\Dictionary;
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
            'min_publication_year' => $minPubYear = rand(1850, 2019),
            'max_publication_year' => ($minPubYear + rand(1, 5)),
            'demand_status' => Dictionary::where('type', 'demand_status')->inRandomOrder()->first()->value,
        ];
    }
}

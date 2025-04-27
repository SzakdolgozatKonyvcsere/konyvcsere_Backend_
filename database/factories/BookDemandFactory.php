<?php

namespace Database\Factories;

use App\Models\BookDemand;
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
    protected $model = BookDemand::class;

    public function definition(): array
    {
         /*return [
           'user' => User::all()->random()->id, // Hozzárendeli egy véletlenszerű User-hez
            'publisher' => Publisher::all()->random()->publisher_id,
            'work' => Work::all()->random()->work_id,
            'language' => $this->faker->unique()->languageCode,
            'min_publication_year' => $minPubYear = rand(1850, 2019),
            'max_publication_year' => ($minPubYear + rand(1, 5)),
            'demand_status' => Dictionary::where('type', 'demand_status')->inRandomOrder()->first()->value,
            */
             // Véletlenszerű intervallum a publication_year-re
        $minYear = $this->faker->numberBetween(1850, now()->year - 1);
        $maxYear = $minYear + $this->faker->numberBetween(1, 5);

        return [
            'user'               => User::factory(),
            'publisher'          => Publisher::factory(),
            'work'               => Work::factory(),
            'language'              => $this->faker->languageCode,
            'min_publication_year'  => $minYear,
            'max_publication_year'  => $maxYear,
            'demand_status'         => 'k',      // vagy ami a te alapértéked
        
        ];
    }
}

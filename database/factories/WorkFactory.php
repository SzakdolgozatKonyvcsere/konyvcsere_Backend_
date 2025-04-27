<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'genre_id' => Genre::all()->random()->genre_id,
            'genre_id' => Genre::factory(),
            'title' =>$this->faker->unique()->sentence(2),
        ];
    }
}

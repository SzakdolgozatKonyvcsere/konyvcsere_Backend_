<?php

namespace Database\Factories;

use App\Models\Dictionary;
use App\Models\Publisher;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookOffer>
 */
class BookOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => User::all()->random()->id, // Hozzárendeli egy véletlenszerű User-hez// Kapcsolat egy User rekorddal
            'publisher' => Publisher::all()->random()->publisher_id,// Kapcsolat egy Kiado rekorddal
            'work' => Work::all()->random()->work_id,// Kapcsolat egy Mu rekorddal
            'language' => fake()->word(), // Véletlenszerű nyelvkód (pl. 'en', 'hu')
            'publication_year' => fake()->year(), // Véletlenszerű kiadási év
            'quality' => rand(0,5),
            'book_status' => Dictionary::where('type', 'book_status')->inRandomOrder()->first()->value, // Állapot

            'img_url' => $this->faker->imageUrl(640, 480, 'books', true, 'Könyv kép'), // Véletlenszerű könyvkép URL*/

        ]; 
    }
}

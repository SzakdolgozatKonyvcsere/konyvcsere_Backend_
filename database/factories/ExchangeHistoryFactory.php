<?php

namespace Database\Factories;

use App\Models\BookDemand;
use App\Models\BookOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExchangeHistory>
 */
class ExchangeHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'interested_user' => User::all()->random()->id,
            'desired_item' => BookOffer::all()->random()->offer_id,
            'offered_item' => BookOffer::all()->random()->offer_id,
            'exchange_status' => fake()->randomElement(['függőben', 'elfogadva', 'elutasítva'])
       
        ]; 
    }
}

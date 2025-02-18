<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Publisher;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WrittenBy>
 */
class WrittenByFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'work' => Work::inRandomOrder()->value('work_id'),
            'author' => Author::inRandomOrder()->value('author_id')
        
        ];
    }
}

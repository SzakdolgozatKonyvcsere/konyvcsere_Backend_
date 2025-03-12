<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Publisher;
use App\Models\Work;
use App\Models\WrittenBy;
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
        do {
            $work = Work::inRandomOrder()->value('work_id');
            $author = Author::inRandomOrder()->value('author_id');
        } while (WrittenBy::where('work', $work)->where('author', $author)->exists());
        
        return [
            'work' => $work,
            'author' => $author,
        ];
    }
}

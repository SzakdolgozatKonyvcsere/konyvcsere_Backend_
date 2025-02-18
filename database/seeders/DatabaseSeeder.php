<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\BookDemand;
use App\Models\BookOffer;
use App\Models\Dictionary;
use App\Models\ExchangeHistory;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\User;
use App\Models\Work;
use App\Models\WrittenBy;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        User::factory()->create([
            'name' => 'admin_michael',
            'email' => 'michael@admin.com',
            'password' => 'michael12345',
            'full_name' => 'Sir Michael Adminsson',
            'tel' => fake()->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 0
        ]);

        User::factory()->create([
            'name' => 'test_sophia',
            'email' => 'sophia@test.com',
            'password' => 'sophia12345',
            'full_name' => 'Sophia Tucker',
            'tel' => fake()->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 1
        ]);
        User::factory()->create([
            'name' => 'test_andrew',
            'email' => 'andrew@test.com',
            'password' => 'andrew12345',
            'full_name' => 'Andrew Smith',
            'tel' => fake()->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 1
        ]);

        $genres = [
            'Regény',
            'Sci-fi',
            'Történelmi',
            'Krimi',
            'Fantasy',
            'Dráma',
            'Gyermekirodalom',
            'Vers',
            'Életrajz',
            'Tudományos'
        ];

        foreach ($genres as $genreName) {
            Genre::factory()->create([
                'genre_name' => $genreName,
            ]);
        }


        Publisher::factory(10)->create();
        Author::factory(10)->create();
        Work::factory(10)->create();
        WrittenBy::factory(5)->create();
        BookDemand::factory(10)->create();
        BookOffer::factory(10)->create();
        ExchangeHistory::factory(6)->create();
        Dictionary::factory(10)->create();
    }
}

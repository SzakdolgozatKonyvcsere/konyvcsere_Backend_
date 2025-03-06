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
        $this->call([
            UsersTableSeeder::class,
            GenresTableSeeder::class,
            Exchange_HistoriesTableSeeder::class,
            PublishersTableSeeder::class,
            WorksTableSeeder::class,
            AuthorsTableSeeder::class,
            Book_OffersTableSeeder::class,
            Book_DemandsTableSeeder::class,
            DictionariesTableSeeder::class,
            Written_BiesTableSeeder::class,
        ]);

        
        Author::factory(10)->create();
        Work::factory(10)->create();
        WrittenBy::factory(5)->create();
        BookDemand::factory(10)->create();
        BookOffer::factory(10)->create();
        ExchangeHistory::factory(6)->create();
        
    }
}

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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*$this->call([
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
        ]);*/

        User::factory()->create([
            'name' => 'admin_michael',
            'email' => 'michael@admin.com',
            'password' => Hash::make('michael12345'),
            'full_name' => 'Sir Michael Adminsson',
            'tel' => fake()->unique->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 0,
            'online_status' => 0,
            'img_url' => "https://i.pinimg.com/1200x/2c/47/d5/2c47d5dd5b532f83bb55c4cd6f5bd1ef.jpg"
        ]);

        User::factory()->create([
            'name' => 'test_sophia',
            'email' => 'sophia@test.com',
            'password' => Hash::make('sophia12345'),
            'full_name' => 'Sophia Tucker',
            'tel' => fake()->unique->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 1,
            'online_status' => 0,
            'img_url' => "https://i.pinimg.com/1200x/2c/47/d5/2c47d5dd5b532f83bb55c4cd6f5bd1ef.jpg"
        ]);
        
        User::factory()->create([
            'name' => 'test_andrew',
            'email' => 'andrew@test.com',
            'password' => Hash::make('andrew12345'),
            'full_name' => 'Andrew Smith',
            'tel' => fake()->unique->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 1,
            'online_status' => 0,
            'img_url' => "https://i.pinimg.com/1200x/2c/47/d5/2c47d5dd5b532f83bb55c4cd6f5bd1ef.jpg"
        ]);
        

        $genres = [
            'Regény','Sci-Fi','Fantasy','Dráma','Horror','Romantikus','Kaland','Krimi',
            'Thriller','Történelmi','Életrajzi','Szatíra','Humor','Disztópia',
            'Posztapokaliptikus','Gasztronómiai','Pszichológiai','Háborús','Politikai',
            'Filozófiai','Esszé','Napló','Verseskötet','Ifjúsági','Gyermekkönyv',
            'Képregény','Manga','Vallási','Önsegítő','Ismeretterjesztő','Tudományos',
            'Oktatási','Dokumentumregény', 'Egyéb'
        ];

        foreach ($genres as $genreName) {
            Genre::factory()->create([
                'genre_name' => $genreName,
            ]);
        }


        $statuses = [
            'demand_status' => ['e', 'k', 't'],
            'book_status' => ['e', 'f', 's'],
            'exchange_status' => ['a', 'k', 'f', 'v']
        ];
        
        foreach ($statuses as $type => $values) {
            foreach ($values as $value) {
                Dictionary::factory()->create([
                    'type'  => $type,
                    'value' => $value,
                ]);
            }
        }


        Publisher::factory(10)->create();
        Work::factory(10)->create();
        Author::factory(10)->create();
        WrittenBy::factory(4)->create();
        BookOffer::factory(10)->create();
        BookDemand::factory(10)->create();
        ExchangeHistory::factory(6)->create();
        
    }
}

<?php

namespace Database\Seeders;

use App\Models\BookOffer;
use App\Models\Publisher;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Book_OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('book_offers')->insert([
            //1. felh: id:2, Sophia
            //szabad - s
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Móra')->value('publisher_id'),
                'work' => Work::where('work_id', 1)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2022,
                'quality' => 5,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Osiris')->value('publisher_id'),
                'work' => Work::where('work_id', 2)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2019,
                'quality' => 4,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Akkord')->value('publisher_id'),
                'work' => Work::where('work_id', 3)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2013,
                'quality' => 3,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 4)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2021,
                'quality' => 4,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Magvető')->value('publisher_id'),
                'work' => Work::where('work_id', 5)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Laulin')->value('publisher_id'),
                'work' => Work::where('work_id', 6)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 4,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Könyvmolyképző')->value('publisher_id'),
                'work' => Work::where('work_id', 7)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2015,
                'quality' => 3,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Helikon')->value('publisher_id'),
                'work' => Work::where('work_id', 8)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Kreatív')->value('publisher_id'),
                'work' => Work::where('work_id', 9)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2022,
                'quality' => 4,
                'book_status' => 's'
            ],
            // elcserelve + atadve - e + a
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Holnap')->value('publisher_id'),
                'work' => Work::where('work_id', 24)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2016,
                'quality' => 4,
                'book_status' => 'e'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Akkord')->value('publisher_id'),
                'work' => Work::where('work_id', 29)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 'e'
            ],
            // foglalt + kezdemenyezes - f + k
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Magvető')->value('publisher_id'),
                'work' => Work::where('work_id', 32)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 'f'
            ],

            

            //2. felh: id:3, Andrew
            //szabad - s
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Kulcslyuk')->value('publisher_id'),
                'work' => Work::where('work_id', 10)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 5,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Magvető')->value('publisher_id'),
                'work' => Work::where('work_id', 11)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2025,
                'quality' => 5,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Könyvmolyképző')->value('publisher_id'),
                'work' => Work::where('work_id', 12)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2016,
                'quality' => 2,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Kulcslyuk')->value('publisher_id'),
                'work' => Work::where('work_id', 13)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2011,
                'quality' => 4,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 14)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 5,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Uitgeverij De Harmonie')->value('publisher_id'),
                'work' => Work::where('work_id', 15)->value('work_id'),
                'language' => 'holland',
                'publication_year' => 2001,
                'quality' => 3,
                'book_status' => 's'
            ],
            // elcserelve + atadve - e + a
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 25)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2009,
                'quality' => 3,
                'book_status' => 'e'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Harper & Row')->value('publisher_id'),
                'work' => Work::where('work_id', 27)->value('work_id'),
                'language' => 'angol',
                'publication_year' => 1990,
                'quality' => 2,
                'book_status' => 'e'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Magvető')->value('publisher_id'),
                'work' => Work::where('work_id', 31)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2022,
                'quality' => 4,
                'book_status' => 'e'
            ],

            //3. felh: id:4, Theodore
            //szabad - s
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Kossuth')->value('publisher_id'),
                'work' => Work::where('work_id', 16)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 1987,
                'quality' => 3,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Új Magyar')->value('publisher_id'),
                'work' => Work::where('work_id', 17)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 1951,
                'quality' => 4,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Corgi Books')->value('publisher_id'),
                'work' => Work::where('work_id', 18)->value('work_id'),
                'language' => 'angol',
                'publication_year' => 2004,
                'quality' => 4,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Balassi')->value('publisher_id'),
                'work' => Work::where('work_id', 19)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2025,
                'quality' => 5,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 9)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 5,
                'book_status' => 's'
            ],
            
            // elcserelve + atadve - e + a
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Móra')->value('publisher_id'),
                'work' => Work::where('work_id', 23)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 1963,
                'quality' => 3,
                'book_status' => 'e'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Scolar')->value('publisher_id'),
                'work' => Work::where('work_id', 26)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2021,
                'quality' => 5,
                'book_status' => 'e'
            ],
            // foglalt + folyamatban - f + f
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Akkord')->value('publisher_id'),
                'work' => Work::where('work_id', 34)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 'f'
            ],


            //4. felh: id:5, Marika 
            //szabad - s
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Manó')->value('publisher_id'),
                'work' => Work::where('work_id', 20)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 5,
                'book_status' => 's'
            ],
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Könyvmolyképző')->value('publisher_id'),
                'work' => Work::where('work_id', 21)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2016,
                'quality' => 2,
                'book_status' => 's'
            ],
            //elcserelt + atadva - e + a
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 22)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2020,
                'quality' => 5,
                'book_status' => 'e'
            ],
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Kreatív')->value('publisher_id'),
                'work' => Work::where('work_id', 28)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2022,
                'quality' => 5,
                'book_status' => 'e'
            ],
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Helikon')->value('publisher_id'),
                'work' => Work::where('work_id', 30)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 3,
                'book_status' => 'e'
            ],
            // foglalt + kezdemenyezes - f + k
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Osiris')->value('publisher_id'),
                'work' => Work::where('work_id', 33)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 'f'
            ],
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Napvilág')->value('publisher_id'),
                'work' => Work::where('work_id', 35)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2014,
                'quality' => 5,
                'book_status' => 'f'
            ],

            
        ]);
    }
}

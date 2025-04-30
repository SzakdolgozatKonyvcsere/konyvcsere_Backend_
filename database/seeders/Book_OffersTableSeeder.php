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
                'book_status' => 's',
                'img_url' => 'books_pictures/LegyJoMindhalaligMoricz.jpg', // Kép elérési útja
                'created_at' => '2025-04-25 09:43:29',
                'updated_at' => '2025-04-25 09:43:29'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Osiris')->value('publisher_id'),
                'work' => Work::where('work_id', 2)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2019,
                'quality' => 4,
                'book_status' => 's',
                'img_url' => 'books_pictures/kosztolanyiedesanna.jpg',
                'created_at' => '2025-03-25 10:43:29',
                'updated_at' => '2025-03-25 10:43:29'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Akkord')->value('publisher_id'),
                'work' => Work::where('work_id', 3)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2013,
                'quality' => 3,
                'book_status' => 's',
                'img_url' => 'books_pictures/RokonokMoricz.jpg',
                'created_at' => '2024-12-15 11:40:30',
                'updated_at' => '2024-12-15 11:40:30'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 4)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2021,
                'quality' => 4,
                'book_status' => 's',
                'img_url' => 'books_pictures/KoszivuEuropaK.jpg',
                'created_at' => '2025-02-02 15:45:35',
                'updated_at' => '2025-02-02 15:50:20'
            ],
            /*[
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Magvető')->value('publisher_id'),
                'work' => Work::where('work_id', 5)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 's',
                'img_url' => 'books_pictures/UtasEsHoldvilagSzerb.jpg',
                'created_at' => '2025-02-13 10:30:33',
                'updated_at' => '2025-02-13 10:30:33'
            ],*/
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Laulin')->value('publisher_id'),
                'work' => Work::where('work_id', 6)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 4,
                'book_status' => 's',
                'img_url' => 'books_pictures/NemEgyszeruLeiner.jpg',
                'created_at' => '2025-03-23 14:22:55',
                'updated_at' => '2025-03-23 14:22:55'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Könyvmolyképző')->value('publisher_id'),
                'work' => Work::where('work_id', 7)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2015,
                'quality' => 3,
                'book_status' => 's',
                'img_url' => 'books_pictures/RubinvorosGier.jpg',
                'created_at' => '2025-04-11 18:44:07',
                'updated_at' => '2025-04-11 18:44:07'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Helikon')->value('publisher_id'),
                'work' => Work::where('work_id', 8)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 's',
                'img_url' => 'books_pictures/OsziBorzongasChristie.jpg',
                'created_at' => '2025-04-14 17:02:06',
                'updated_at' => '2025-04-14 17:02:06'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Kreatív')->value('publisher_id'),
                'work' => Work::where('work_id', 9)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2022,
                'quality' => 4,
                'book_status' => 's',
                'img_url' => 'books_pictures/EgriCsillagokKreativK.jpg',
                'created_at' => '2025-03-25 16:33:17',
                'updated_at' => '2025-03-25 16:33:17'
            ],
            // elcserelve + atadve - e + a
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Holnap')->value('publisher_id'),
                'work' => Work::where('work_id', 24)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2016,
                'quality' => 4,
                'book_status' => 'e',
                'img_url' => 'books_pictures/KincsesSzigetStevenson.jpg',
                'created_at' => '2025-01-13 14:46:28',
                'updated_at' => '2025-01-13 14:46:28'
            ],
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Akkord')->value('publisher_id'),
                'work' => Work::where('work_id', 29)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 'e',
                'img_url' => 'books_pictures/SzigetiVeszedelemZrinyi.jpg',
                'created_at' => '2024-12-22 15:39:03',
                'updated_at' => '2024-12-22 15:39:03'
            ],
            // foglalt + kezdemenyezes - f + k
            [
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Magvető')->value('publisher_id'),
                'work' => Work::where('work_id', 32)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 'f',
                'img_url' => 'books_pictures/UtasEsHoldvilagSzerb.jpg',
                'created_at' => '2025-02-22 12:34:51',
                'updated_at' => '2025-02-22 12:34:51'
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
                'book_status' => 's',
                'img_url' => 'books_pictures/LelekragcsalokPopper.jpg',
                'created_at' => '2025-02-13 14:13:32',
                'updated_at' => '2025-02-13 14:13:32'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Magvető')->value('publisher_id'),
                'work' => Work::where('work_id', 11)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2025,
                'quality' => 5,
                'book_status' => 's',
                'img_url' => 'books_pictures/HobbitTolkien.jpg',
                'created_at' => '2025-02-18 13:34:23',
                'updated_at' => '2025-02-18 13:34:23'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Könyvmolyképző')->value('publisher_id'),
                'work' => Work::where('work_id', 12)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2016,
                'quality' => 2,
                'book_status' => 's',
                'img_url' => 'books_pictures/SzornyekTengereRiordan.jpg',
                'created_at' => '2025-03-20 09:02:32',
                'updated_at' => '2025-03-20 09:02:32'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Kulcslyuk')->value('publisher_id'),
                'work' => Work::where('work_id', 13)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2011,
                'quality' => 4,
                'book_status' => 's',
                'img_url' => 'books_pictures/BelenkEgettMultBagdy.jpg',
                'created_at' => '2025-02-11 08:07:57',
                'updated_at' => '2025-02-11 08:07:57'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 14)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 5,
                'book_status' => 's',
                'img_url' => 'books_pictures/CsipkerozsikakKing.jpg',
                'created_at' => '2025-03-21 10:34:12',
                'updated_at' => '2025-03-21 10:34:12'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Uitgeverij De Harmonie')->value('publisher_id'),
                'work' => Work::where('work_id', 15)->value('work_id'),
                'language' => 'holland',
                'publication_year' => 2001,
                'quality' => 3,
                'book_status' => 's',
                'img_url' => 'books_pictures/HPholland.jpg',
                'created_at' => '2025-04-12 11:54:23',
                'updated_at' => '2025-04-12 11:54:23'
            ],
            // elcserelve + atadve - e + a
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 25)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2009,
                'quality' => 3,
                'book_status' => 'e',
                'img_url' => 'books_pictures/NemZorogAHarasztChristie.jpg',
                'created_at' => '2025-03-24 12:43:11',
                'updated_at' => '2025-03-24 12:43:11'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Harper & Row')->value('publisher_id'),
                'work' => Work::where('work_id', 27)->value('work_id'),
                'language' => 'angol',
                'publication_year' => 1990,
                'quality' => 2,
                'book_status' => 'e',
                'img_url' => 'books_pictures/WritingProcessPinnels.jpg',
                'created_at' => '2025-03-02 13:46:56',
                'updated_at' => '2025-03-02 13:46:56'
            ],
            [
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Magvető')->value('publisher_id'),
                'work' => Work::where('work_id', 31)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2022,
                'quality' => 4,
                'book_status' => 'e',
                'img_url' => 'books_pictures/ApendragonLegendaSzerb.jpg',
                'created_at' => '2025-04-10 14:23:49',
                'updated_at' => '2025-04-10 14:23:49'
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
                'book_status' => 's',
                'img_url' => 'books_pictures/MarciusiSzelKuzmicsov.jpg',
                'created_at' => '2025-04-16 13:49:11',
                'updated_at' => '2025-04-16 13:49:11'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Új Magyar')->value('publisher_id'),
                'work' => Work::where('work_id', 17)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 1951,
                'quality' => 4,
                'book_status' => 's',
                'img_url' => 'books_pictures/AcelEsSalakPopov.jpg',
                'created_at' => '2025-04-05 15:11:08',
                'updated_at' => '2025-04-05 15:11:08'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Corgi Books')->value('publisher_id'),
                'work' => Work::where('work_id', 18)->value('work_id'),
                'language' => 'angol',
                'publication_year' => 2004,
                'quality' => 4,
                'book_status' => 's',
                'img_url' => 'books_pictures/TheDaVinciCodeBrown.jpg',
                'created_at' => '2025-04-11 13:28:19',
                'updated_at' => '2025-04-11 13:28:19'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Balassi')->value('publisher_id'),
                'work' => Work::where('work_id', 19)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2025,
                'quality' => 5,
                'book_status' => 's',
                'img_url' => 'books_pictures/MegszolalAzAlarendeltZsadanyi.jpg',
                'created_at' => '2025-03-01 15:20:55',
                'updated_at' => '2025-03-01 15:20:55'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 9)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 5,
                'book_status' => 's',
                'img_url' => 'books_pictures/EgriCsillagokEuropaK.jpg',
                'created_at' => '2025-01-27 19:19:03',
                'updated_at' => '2025-01-27 19:19:03'
            ],
            
            // elcserelve + atadve - e + a
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Móra')->value('publisher_id'),
                'work' => Work::where('work_id', 23)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 1963,
                'quality' => 3,
                'book_status' => 'e',
                'img_url' => 'books_pictures/HazaiTukorTamasi.jpg',
                'created_at' => '2025-01-14 20:43:19',
                'updated_at' => '2025-01-14 20:43:19'
            ],
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Scolar')->value('publisher_id'),
                'work' => Work::where('work_id', 26)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2021,
                'quality' => 5,
                'book_status' => 'e',
                'img_url' => 'books_pictures/ASzellemCGJung.jpg',
                'created_at' => '2025-02-06 17:40:27',
                'updated_at' => '2025-02-06 17:40:27'
            ],
            // foglalt + folyamatban - f + f
            [
                'user' => User::where('id', 4)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Akkord')->value('publisher_id'),
                'work' => Work::where('work_id', 34)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 'f',
                'img_url' => 'books_pictures/GoirotApoBalzac.jpg',
                'created_at' => '2025-02-16 16:26:06',
                'updated_at' => '2025-02-16 16:26:06'
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
                'book_status' => 's',
                'img_url' => 'books_pictures/KoszivuNogradiJokai.jpg',
                'created_at' => '2025-03-11 14:17:10',
                'updated_at' => '2025-03-11 14:17:10'
            ],
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Könyvmolyképző')->value('publisher_id'),
                'work' => Work::where('work_id', 21)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2016,
                'quality' => 2,
                'book_status' => 's',
                'img_url' => 'books_pictures/RopiNaplojaKinney.jpg',
                'created_at' => '2025-03-28 12:15:36',
                'updated_at' => '2025-03-28 12:15:36'
            ],
            //elcserelt + atadva - e + a
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Európa')->value('publisher_id'),
                'work' => Work::where('work_id', 22)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2020,
                'quality' => 5,
                'book_status' => 'e',
                'img_url' => 'books_pictures/AllatfarmOrwell.jpg',
                'created_at' => '2025-03-01 19:52:07',
                'updated_at' => '2025-03-01 19:52:07'
            ],
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Kreatív')->value('publisher_id'),
                'work' => Work::where('work_id', 28)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2022,
                'quality' => 5,
                'book_status' => 'e',
                'img_url' => 'books_pictures/JanosVitezPetofi.jpg',
                'created_at' => '2025-04-17 22:04:25',
                'updated_at' => '2025-04-17 22:04:25'
            ],
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Helikon')->value('publisher_id'),
                'work' => Work::where('work_id', 30)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2023,
                'quality' => 3,
                'book_status' => 'e',
                'img_url' => 'books_pictures/OtKismalacChristie.jpg',
                'created_at' => '2025-04-22 16:26:11',
                'updated_at' => '2025-04-22 16:26:11'
            ],
            // foglalt + kezdemenyezes - f + k
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Osiris')->value('publisher_id'),
                'work' => Work::where('work_id', 33)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2024,
                'quality' => 5,
                'book_status' => 'f',
                'img_url' => 'books_pictures/EstiKornelKosztolanyi.jpg',
                'created_at' => '2025-03-18 14:22:54',
                'updated_at' => '2025-03-18 14:22:54'
            ],
            [
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Napvilág')->value('publisher_id'),
                'work' => Work::where('work_id', 35)->value('work_id'),
                'language' => 'magyar',
                'publication_year' => 2014,
                'quality' => 5,
                'book_status' => 'f',
                'img_url' => 'books_pictures/HorthyMiklosTubucz.jpg',
                'created_at' => '2025-03-04 12:16:33',
                'updated_at' => '2025-03-04 12:16:33'
            ],

            
        ]);
    }
}

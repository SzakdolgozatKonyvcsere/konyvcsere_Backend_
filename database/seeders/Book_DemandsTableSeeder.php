<?php

namespace Database\Seeders;

use App\Models\Publisher;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Book_DemandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('book_demands')->insert([
            //1. felh: id:2, Sophia
            //keres - k
            [//A hobbit, Jrr Tolkien, 2000-2010, fantasy
                'user' => User::where('id', 2)->value('id'),
                'publisher' => null,
                'work' => Work::where('work_id', 11)->value('work_id'),
                'language' => null,
                'min_publication_year' => 2000,
                'max_publication_year' => 2010,
                'demand_status' => 'k'
            ],
            
            [//szentpéter esernyoje, mikszath kalman, 2020-2025
                'user' => User::where('id', 2)->value('id'),
                'publisher' => null,
                'work' => Work::where('work_id', 36)->value('work_id'),
                'language' => null,
                'min_publication_year' => 2020,
                'max_publication_year' => 2025,
                'demand_status' => 'k'
            ],
            [//tanarur kerem, karinthy, 2005-2025, osiris, magy, reg
                'user' => User::where('id', 2)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Osiris')->value('publisher_id'),
                'work' => Work::where('work_id', 37)->value('work_id'),
                'language' => 'magyar',
                'min_publication_year' => 2005,
                'max_publication_year' => 2025,
                'demand_status' => 'k'
            ],
            //TALALT
            [//Harry Potter en de Vuurbeker, JK Rowlng, 1997-2005, hlland
                'user' => User::where('id', 2)->value('id'),
                'publisher' => null,
                'work' => Work::where('work_id', 15)->value('work_id'),
                'language' => 'holland',
                'min_publication_year' => 1997,
                'max_publication_year' => 2005,
                'demand_status' => 't'
            ],
            //elcserelve - e
            [//janosvitez, petofi, 2015-2025, magyar
                'user' => User::where('id', 2)->value('id'),
                'publisher' => null,
                'work' => Work::where('work_id', 28)->value('work_id'),
                'language' => 'magyar',
                'min_publication_year' => 2015,
                'max_publication_year' => 2025,
                'demand_status' => 'e'
            ],
            

            //2. felh: id:3, Andrew
            //keres - k
            
            [//davinci, dan brown, angol, krimi
                'user' => User::where('id', 3)->value('id'),
                'publisher' => null,
                'work' => Work::where('work_id', 18)->value('work_id'),
                'language' => 'magyar',
                'min_publication_year' => null,
                'max_publication_year' => null,
                'demand_status' => 'k'
            ],
            [//fejlilelek, cole cole, osiris, 2006, magy, pszich
                'user' => User::where('id', 3)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Osiris')->value('publisher_id'),
                'work' => Work::where('work_id', 38)->value('work_id'),
                'language' => 'magyar',
                'min_publication_year' => 2006,
                'max_publication_year' => 2006,
                'demand_status' => 'k'
            ],
            //talalt - t
            [//edes anna, kosztolanyi, 2010-2025, magy
                'user' => User::where('id', 3)->value('id'),
                'publisher' => null,
                'work' => Work::where('work_id', 2)->value('work_id'),
                'language' => 'magyar',
                'min_publication_year' => 2010,
                'max_publication_year' => 2025,
                'demand_status' => 't'
            ],
            //elcserelve - e
            [//otkismalac, agatha, krimi, 2020, 2025, magyar
                'user' => User::where('id', 3)->value('id'),
                'publisher' => null,
                'work' => Work::where('work_id', 30)->value('work_id'),
                'language' => 'magyar',
                'min_publication_year' => 2020,
                'max_publication_year' => 2025,
                'demand_status' => 'e'
            ],

            //3. felh: id:4, Theodore
            //keres - k
            //talalt - t
            [//kosivu, nogradi jokai, 2000-2025, magy
                'user' => User::where('id', 4)->value('id'),
                'publisher' => null,
                'work' => Work::where('work_id', 20)->value('work_id'),
                'language' => 'magyar',
                'min_publication_year' => 2000,
                'max_publication_year' => 2025,
                'demand_status' => 't'
            ],

            //4. felh: id:5, MArika
            //keres - k
            [//egri, gardonyi, kreativ, 2000-2025
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Kreatív')->value('publisher_id'),
                'work' => Work::where('work_id', 9)->value('work_id'),
                'language' => null,
                'min_publication_year' => 2000,
                'max_publication_year' => 2020,
                'demand_status' => 'k'
            ],
            //elcserelve - e
            [//szigeti veszedelem, zrinyi, 2000-2025, akkord, magy
                'user' => User::where('id', 5)->value('id'),
                'publisher' => Publisher::where('publisher_name', 'Akkord')->value('publisher_id'),
                'work' => Work::where('work_id', 29)->value('work_id'),
                'language' => 'magyar',
                'min_publication_year' => 2000,
                'max_publication_year' => 2025,
                'demand_status' => 'e'
            ],

        ]);
    }
}

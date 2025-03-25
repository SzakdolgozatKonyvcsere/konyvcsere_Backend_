<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Work::factory()->createMany([
            //1.f
            //s
            [//id:1
            "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
            "title" => 'Légy jó mindhalálig',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Édes Anna',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Rokonok',
            ],
            [// !!!!!!!! 4
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'A kőszívű ember fiai',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Utas és holdvilág',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Romantikus')->value('genre_id'),
                "title" => 'Nem egyszerű',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Romantikus')->value('genre_id'),
                "title" => 'Rubinvörös – Időtlen szerelem',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Krimi')->value('genre_id'),
                "title" => 'Őszi borzongás',
            ],
            [//!!!
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Egri csillagok',
            ],

            //2.f
            //s
            [//id:10.
                "genre_id" => Genre::where('genre_name', 'Pszichológiai')->value('genre_id'),
                "title" => 'Lélekrágcsálók',
            ],
            [//11
                "genre_id" => Genre::where('genre_name', 'Fantasy')->value('genre_id'),
                "title" => 'A hobbit',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Fantasy')->value('genre_id'),
                "title" => 'Percy Jackson és az olimposziak 2. - A szörnyek tengere',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Pszichológiai')->value('genre_id'),
                "title" => 'A belénk égett múlt – Elengedés, megbocsájtás, újrakezdés',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Thriller')->value('genre_id'),
                "title" => 'Csipkerózsikák',
            ],
            [//15
                "genre_id" => Genre::where('genre_name', 'Fantasy')->value('genre_id'),
                "title" => 'Harry Potter en de Vuurbeker',
            ],
            //3.f
            //s
            [//id:16
                "genre_id" => Genre::where('genre_name', 'Történelmi')->value('genre_id'),
                "title" => 'Márciusi szél',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Történelmi')->value('genre_id'),
                "title" => 'Acél és Salak (dedikált)',
            ],
            [//18
                "genre_id" => Genre::where('genre_name', 'Krimi')->value('genre_id'),
                "title" => 'The Da Vinci Code',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Tudományos')->value('genre_id'),
                "title" => 'Megszólal az alárendelt? - A kiszolgáltatottak történetmondása 20-21. századi irodalmi művekben',
            ],
            //4.f
            //s
            [//id:20
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Kőszívű ember fiai',
            ],
            [
                "genre_id" => Genre::where('genre_name', 'Képregény')->value('genre_id'),
                "title" => 'Egy ropi naplója',
            ],
            // -----------
            //4. e
            [ //22
                "genre_id" => Genre::where('genre_name', 'Szatíra')->value('genre_id'),
                "title" => 'Állatfarm',
            ],
            //3. e
            [ //23
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Hazai Tükör',
            ],
            //1. e
            [ //24
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Kincses Sziget',
            ],
            //2. e
            [ //25
                "genre_id" => Genre::where('genre_name', 'Krimi')->value('genre_id'),
                "title" => 'Nem zörög a haraszt',
            ],
            //3. e
            [ //26
                "genre_id" => Genre::where('genre_name', 'Pszichológiai')->value('genre_id'),
                "title" => 'A szellem jelensége a művészetben és a tudományban',
            ],
            //?
            [ //27
                "genre_id" => Genre::where('genre_name', 'Oktatási')->value('genre_id'),
                "title" => 'Writing Process and Structure',
            ],
            //4. e
            [ //28
                "genre_id" => Genre::where('genre_name', 'Verseskötet')->value('genre_id'),
                "title" => 'János vitéz',
            ],
            //1. e
            [ //29
                "genre_id" => Genre::where('genre_name', 'Egyéb')->value('genre_id'),
                "title" => 'Szigeti veszedelem',
            ],
            //4. e
            [ //30
                "genre_id" => Genre::where('genre_name', 'Krimi')->value('genre_id'),
                "title" => 'Öt kismalac',
            ],
            //2 e
            [ //31
                "genre_id" => Genre::where('genre_name', 'Krimi')->value('genre_id'),
                "title" => 'A pendragon legenda',
            ],
            // 1. f
            [ //32
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Utas és holdvilág',
            ],
            //4 f
            [ //33
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Esti Kornél',
            ],
            //3 f
            [ //34
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Goirot apó',
            ],
            //4 f
            [ //35
                "genre_id" => Genre::where('genre_name', 'Történelmi')->value('genre_id'),
                "title" => 'Horthy Miklós',
            ],

            //1 demand 
            [ //36
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Szent Péter esernyője',
            ],
            [ //37
                "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
                "title" => 'Tanár úr kérem',
            ],
            [//38
                "genre_id" => Genre::where('genre_name', 'Pszichológiai')->value('genre_id'),
                "title" => 'Fejlődéslélektan',
            ],
            
        ]);
        

        /* Work::factory()->create([
            "genre_id" => Genre::where('genre_name', '')->value('genre_id'),
            "title" => $works[1]
        ]); */
        
    }
}

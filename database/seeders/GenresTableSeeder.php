<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}

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
        $works = ["To Kill a Mockingbird"];

        Work::factory()->create([
            "genre_id" => Genre::where('genre_name', 'Regény')->value('genre_id'),
            "title" => $works[0]
        ]);

        /* Work::factory()->create([
            "genre_id" => Genre::where('genre_name', '')->value('genre_id'),
            "title" => $works[1]
        ]); */
        
    }
}

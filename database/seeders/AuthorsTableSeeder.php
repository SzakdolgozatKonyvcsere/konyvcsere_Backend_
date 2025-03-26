<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = ["Harper Lee", "Asd"];

        Author::factory()->createMany([
            [
                'author_name' => 'Móricz Zsigmond',
            ],
            [
                'author_name' => 'Kosztolányi Dezső',
            ],
            [
                'author_name' => 'Jókai Mór',
            ],
            [
                'author_name' => 'Szerb Antal',
            ],
            [
                'author_name' => 'Leiner Laura',
            ],
            [
                'author_name' => 'Kerstin Gier',
            ],
            [
                'author_name' => 'Agatha Christie',
            ],
            [
                'author_name' => 'Gárdonyi Géza',
            ],
            //
            [
                'author_name' => 'Popper Péter',
            ],
            [
                'author_name' => 'J. R. R. Tolkien',
            ],
            [
                'author_name' => 'Rick Riordan',
            ],
            // 4
            [
                'author_name' => 'Dr. Bagdy Emőke',
            ],
            [
                'author_name' => 'Koltai Mária',
            ],
            [
                'author_name' => 'Pál Ferenc',
            ],
            //+popper 4
            // 2
            [
                'author_name' => 'Stephen King',
            ],
            [
                'author_name' => 'Owen King',
            ],
            //2
            [
                'author_name' => 'J. K. Rowling',
            ],
            //
            [
                'author_name' => 'Anatolij Kuzmicsov',
            ],
            [
                'author_name' => 'Popov',
            ],
            [
                'author_name' => 'Dan Brown',
            ],
            [
                'author_name' => 'Zsadányi Edit',
            ],
            //
            [
                'author_name' => 'Nógrádi Gergely',
            ],
            [
                'author_name' => 'Jeff Kinney',
            ],
            //?
            [
                'author_name' => 'George Orwell',
            ],
            [
                'author_name' => 'Tamási Áron',
            ],
            [
                'author_name' => 'Robert Louis Stevenson',
            ],
            [
                'author_name' => 'C. G. Jung',
            ],
            [
                'author_name' => 'Jim Pinnels',
            ],
            [
                'author_name' => 'Petőfi Sándor',
            ],
            [
                'author_name' => 'Zrínyi Miklós',
            ],
            [
                'author_name' => 'Honoré de Balzac',
            ],
            [
                'author_name' => 'Turbucz Dávid',
            ],
            [
                'author_name' => 'Mikszáth Kálmán',
            ],
            [
                'author_name' => 'Karinthy Frigyes',
            ],
            [
                'author_name' => 'Michael Cole',
            ],
            [
                'author_name' => 'Sheila R. Cole',
            ],
            
        ]);
    }
}

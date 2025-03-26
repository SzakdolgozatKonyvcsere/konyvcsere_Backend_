<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Work;
use App\Models\WrittenBy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Written_BiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //WrittenBy::factory()->createMany([
        DB::table('written_bies')->insert([
            [
                "work" => Work::where('work_id', 1)->value('work_id'),
                "author" => Author::where('author_name', 'Móricz Zsigmond')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 2)->value('work_id'),
                "author" => Author::where('author_name', 'Kosztolányi Dezső')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 3)->value('work_id'),
                "author" => Author::where('author_name', 'Móricz Zsigmond')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 4)->value('work_id'),
                "author" => Author::where('author_name', 'Jókai Mór')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 5)->value('work_id'),
                "author" => Author::where('author_name', 'Szerb Antal')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 6)->value('work_id'),
                "author" => Author::where('author_name', 'Leiner Laura')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 7)->value('work_id'),
                "author" => Author::where('author_name', 'Kerstin Gier')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 8)->value('work_id'),
                "author" => Author::where('author_name', 'Agatha Christie')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 9)->value('work_id'),
                "author" => Author::where('author_name', 'Gárdonyi Géza')->value('author_id')
            ],
            //
            [
                "work" => Work::where('work_id', 10)->value('work_id'),
                "author" => Author::where('author_name', 'Popper Péter')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 11)->value('work_id'),
                "author" => Author::where('author_name', 'J. R. R. Tolkien')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 12)->value('work_id'),
                "author" => Author::where('author_name', 'Rick Riordan')->value('author_id')
            ],
            [//4
                "work" => Work::where('work_id', 13)->value('work_id'),
                "author" => Author::where('author_name', 'Dr. Bagdy Emőke')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 13)->value('work_id'),
                "author" => Author::where('author_name', 'Koltai Mária')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 13)->value('work_id'),
                "author" => Author::where('author_name', 'Popper Péter')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 13)->value('work_id'),
                "author" => Author::where('author_name', 'Pál Ferenc')->value('author_id')
            ],//4
            [//2
                "work" => Work::where('work_id', 14)->value('work_id'),
                "author" => Author::where('author_name', 'Stephen King')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 14)->value('work_id'),
                "author" => Author::where('author_name', 'Owen King')->value('author_id')
            ],//2
            [
                "work" => Work::where('work_id', 15)->value('work_id'),
                "author" => Author::where('author_name', 'J. K. Rowling')->value('author_id')
            ],
            //
            [
                "work" => Work::where('work_id', 16)->value('work_id'),
                "author" => Author::where('author_name', 'Anatolij Kuzmicsov')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 17)->value('work_id'),
                "author" => Author::where('author_name', 'Popov')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 18)->value('work_id'),
                "author" => Author::where('author_name', 'Dan Brown')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 19)->value('work_id'),
                "author" => Author::where('author_name', 'Zsadányi Edit')->value('author_id')
            ],
            //
            [
                "work" => Work::where('work_id', 20)->value('work_id'),
                "author" => Author::where('author_name', 'Nógrádi Gergely')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 20)->value('work_id'),
                "author" => Author::where('author_name', 'Jókai Mór')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 21)->value('work_id'),
                "author" => Author::where('author_name', 'Jeff Kinney')->value('author_id')
            ],
            //
            [
                "work" => Work::where('work_id', 22)->value('work_id'),
                "author" => Author::where('author_name', 'George Orwell')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 23)->value('work_id'),
                "author" => Author::where('author_name', 'Tamási Áron')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 24)->value('work_id'),
                "author" => Author::where('author_name', 'Robert Louis Stevenson')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 25)->value('work_id'),
                "author" => Author::where('author_name', 'Agatha Christie')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 26)->value('work_id'),
                "author" => Author::where('author_name', 'C. G. Jung')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 27)->value('work_id'),
                "author" => Author::where('author_name', 'Jim Pinnels')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 28)->value('work_id'),
                "author" => Author::where('author_name', 'Petőfi Sándor')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 29)->value('work_id'),
                "author" => Author::where('author_name', 'Zrínyi Miklós')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 30)->value('work_id'),
                "author" => Author::where('author_name', 'Agatha Christie')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 31)->value('work_id'),
                "author" => Author::where('author_name', 'Szerb Antal')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 32)->value('work_id'),
                "author" => Author::where('author_name', 'Szerb Antal')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 33)->value('work_id'),
                "author" => Author::where('author_name', 'Kosztolányi Dezső')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 34)->value('work_id'),
                "author" => Author::where('author_name', 'Honoré de Balzac')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 35)->value('work_id'),
                "author" => Author::where('author_name', 'Turbucz Dávid')->value('author_id')
            ],


            [
                "work" => Work::where('work_id', 36)->value('work_id'),
                "author" => Author::where('author_name', 'Mikszáth Kálmán')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 37)->value('work_id'),
                "author" => Author::where('author_name', 'Karinthy Frigyes')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 38)->value('work_id'),
                "author" => Author::where('author_name', 'Michael Cole')->value('author_id')
            ],
            [
                "work" => Work::where('work_id', 38)->value('work_id'),
                "author" => Author::where('author_name', 'Sheila R. Cole')->value('author_id')
            ],
            
        ]);
    }
}

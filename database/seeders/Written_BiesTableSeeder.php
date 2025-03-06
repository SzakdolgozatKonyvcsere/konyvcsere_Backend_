<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Work;
use App\Models\WrittenBy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Written_BiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WrittenBy::factory()->create([
            "work" => Work::where('work_name', 'To Kill a Mockingbird'),
            "author" => Author::where('author_name', 'Harper Lee')
        ]);
    }
}

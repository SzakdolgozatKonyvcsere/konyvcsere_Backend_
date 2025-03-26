<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublishersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publisher::factory()->createMany([
            [
                'publisher_name' => 'Móra',
            ],
            [
                'publisher_name' => 'Osiris',
            ],
            [
                'publisher_name' => 'Akkord',
            ],
            [
                'publisher_name' => 'Európa',
            ],
            [
                'publisher_name' => 'Magvető',
            ],
            [
                'publisher_name' => 'Laulin',
            ],
            [
                'publisher_name' => 'Könyvmolyképző',
            ],
            [
                'publisher_name' => 'Helikon',
            ],
            [
                'publisher_name' => 'Kreatív',
            ],
            [
                'publisher_name' => 'Kulcslyuk',
            ],
            [
                'publisher_name' => 'Uitgeverij De Harmonie',
            ],
            [
                'publisher_name' => 'Kossuth',
            ],
            [
                'publisher_name' => 'Új Magyar',
            ],
            [
                'publisher_name' => 'Corgi Books',
            ],
            [
                'publisher_name' => 'Balassi',
            ],
            [
                'publisher_name' => 'Manó',
            ],
            [
                'publisher_name' => 'Holnap',
            ],
            [
                'publisher_name' => 'Scolar',
            ],
            [
                'publisher_name' => 'Harper & Row',
            ],
            [
                'publisher_name' => 'Napvilág',
            ],

            
        ]);
    }
}

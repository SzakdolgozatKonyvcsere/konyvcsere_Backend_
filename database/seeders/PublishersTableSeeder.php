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
        $publishers = ['Libri', 'Agave', 'Európa', 'Helikon', 'Partvonal'];

        foreach($publishers as $publisherName)
        Publisher::factory()->create([
            "publisher_name" => $publisherName
        ]);
    }
}

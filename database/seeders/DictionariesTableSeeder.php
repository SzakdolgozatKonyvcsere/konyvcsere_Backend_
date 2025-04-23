<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DictionariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'demand_status' => ['e', 'k', 't', 'x'],
            'book_status' => ['e', 'f', 's', 'x'],
            'exchange_status' => ['a', 'k', 'f', 'v', 'x']
        ];
        
        foreach ($statuses as $type => $values) {
            foreach ($values as $value) {
                Dictionary::factory()->create([
                    'type'  => $type,
                    'value' => $value,
                ]);
            }
        }
    }
}

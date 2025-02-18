<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'user_name' => 'admin_michael',
            'email' => 'michael@admin.com',
            'password' => 'michael12345',
            'full_name' => 'Sir Michael Adminsson',
            'tel' => fake()->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 0
        ]);

        User::factory()->create([
            'user_name' => 'test_sophia',
            'email' => 'sophia@test.com',
            'password' => 'sophia12345',
            'full_name' => 'Sophia Tucker',
            'tel' => fake()->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 1
        ]);
        User::factory()->create([
            'user_name' => 'test_andrew',
            'email' => 'andrew@test.com',
            'password' => 'andrew12345',
            'full_name' => 'Andrew Smith',
            'tel' => fake()->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 1
        ]);*/
    }
}

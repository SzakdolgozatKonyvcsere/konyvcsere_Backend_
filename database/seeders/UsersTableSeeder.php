<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin_michael',
            'email' => 'michael@admin.com',
            'password' => Hash::make('michael12345'),
            'full_name' => 'Sir Michael Adminsson',
            'tel' => fake()->unique->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 0,
            'online_status' => 0,
            'img_url' => "https://img.freepik.com/premium-vector/user-icons-includes-user-icons-people-icons-symbols-premiumquality-graphic-design-elements_981536-526.jpg?semt=ais_hybrid"
        ]);

        User::factory()->create([
            'name' => 'test_sophia',
            'email' => 'sophia@test.com',
            'password' => Hash::make('sophia12345'),
            'full_name' => 'Sophia Tucker',
            'tel' => fake()->unique->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 1,
            'online_status' => 0,
            'img_url' => "https://img.freepik.com/premium-vector/user-icons-includes-user-icons-people-icons-symbols-premiumquality-graphic-design-elements_981536-526.jpg?semt=ais_hybrid"
        ]);
        
        User::factory()->create([
            'name' => 'test_andrew',
            'email' => 'andrew@test.com',
            'password' => Hash::make('andrew12345'),
            'full_name' => 'Andrew Smith',
            'tel' => fake()->unique->phoneNumber(),
            'remember_token' => Str::random(30),
            'role' => 1,
            'online_status' => 0,
            'img_url' => "https://img.freepik.com/premium-vector/user-icons-includes-user-icons-people-icons-symbols-premiumquality-graphic-design-elements_981536-526.jpg?semt=ais_hybrid"
        ]);
    }
}

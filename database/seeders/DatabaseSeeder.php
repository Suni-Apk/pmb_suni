<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '12345678',
            'token' => rand(11111,9999),
            'active' => 1,
            'phone' => '082346739790',
            'gender' => 'Laki-Laki',
            'birthdate' => '2023-10-20',
            'role' => 'Admin',
        ]);
    }
}

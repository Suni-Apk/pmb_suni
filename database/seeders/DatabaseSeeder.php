<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TahunAjaran;
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
            'token' => rand(11111, 9999),
            'active' => 1,
            'phone' => '082346739790',
            'gender' => 'Laki-Laki',
            'role' => 'Admin',
            'status' => 'on'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@example.com',
            'password' => 'password',
            'token' => rand(11111, 9999),
            'active' => 1,
            'phone' => '089608494411',
            'gender' => 'Laki-Laki',
            'role' => 'Mahasiswa',
            'status' => 'on'
        ]);

        $this->call([
            NotifySeeder::class,
            TahunAjaranSeeder::class,
            AdministrasiSeeder::class
        ]);
    }
}

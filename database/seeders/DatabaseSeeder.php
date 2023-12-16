<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jurusan;
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
            'password' => bcrypt('12345678'),
            'token' => rand(11111, 9999),
            'active' => 1,
            // 'phone' => '082346739790',
            'phone' => '012345678901',
            'gender' => 'Laki-Laki',
            'role' => 'Admin',
            'status' => 'on'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Asep Kastelo',
            'email' => 'mahasiswa@example.com',
            'password' => bcrypt('12345678'),
            'token' => rand(11111, 9999),
            'active' => 0,
            'phone' => '012345678902',
            'gender' => 'Laki-Laki',
            'role' => 'Mahasiswa',
            'status' => 'on',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Anisa Rostiana',
            'email' => 'peserta@example.com',
            'password' => bcrypt('12345678'),
            'token' => rand(11111, 9999),
            'active' => 0,
            'phone' => '012345678903',
            'gender' => 'Perempuan',
            'role' => 'Mahasiswa',
            'status' => 'on',
        ]);

        $this->call([
            BannerSeeder::class,
            CourseSeeder::class,
            NotifySeeder::class,
            GeneralSeeder::class,
            JurusanSeeder::class,
            TahunAjaranSeeder::class,
            AdministrasiSeeder::class,
            DescProgramBelajarSeeder::class,
        ]);
    }
}

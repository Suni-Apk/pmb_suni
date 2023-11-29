<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'name'   => 'MABANI',
            'notes'   => ['lorem ipsum dolor sit amet', 'consectetur adipiscing elit'],
        ]);

        Course::create([
            'name'   => 'Dirasah Islamiyah',
            'notes'   => ['lorem ipsum dolor sit amet', 'consectetur adipiscing elit', 'iyahh'],
        ]);
    }
}

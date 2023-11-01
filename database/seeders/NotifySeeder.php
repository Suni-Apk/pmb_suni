<?php

namespace Database\Seeders;

use App\Models\Notify;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notify = [
            'notif_otp' => 'Di Coba Gesy'
        ];
        Notify::create($notify);
    }
}

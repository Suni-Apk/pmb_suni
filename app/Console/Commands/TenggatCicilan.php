<?php

namespace App\Console\Commands;

use App\Models\Cicilan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TenggatCicilan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tenggat-cicilan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cicilan = Cicilan::where('end_date', date('Y-m-d'))->where('status', 'BELUM')->get();
        foreach ($cicilan as $cicilans) {
            Log::info($cicilans->tagihanDetail->users->phone);
        }
    }
}

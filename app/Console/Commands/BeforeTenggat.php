<?php

namespace App\Console\Commands;

use App\Models\TagihanDetail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BeforeTenggat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:before-tenggat';

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
        // $tagihanDetail = TagihanDetail::all();
        Log::info('tess');
        // foreach ($tagihanDetail as $keys => $value) {
        //     $end_date = strtotime('-10 days', strtotime($value->end_date));
        //     $end_dates = date('Y-m-d', $end_date);
        //     if ($end_dates == date('Y-m-d')) {
        //         Log::info('sdasdas');
        //     }
        // }
    }
}

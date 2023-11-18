<?php

namespace App\Jobs;

use App\Models\TagihanDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BeforeTenggatJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tagihanDetail = TagihanDetail::all();

        foreach ($tagihanDetail as $keys => $value) {
            $end_date = strtotime('-10 days', strtotime($value->end_date));
            $end_dates = date('Y-m-d', $end_date);
            if ($end_dates == date('Y-m-d')) {
                Log::info('sdasdas');
            }
        }
    }
}

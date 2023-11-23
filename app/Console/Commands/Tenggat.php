<?php

namespace App\Console\Commands;

use App\Models\TagihanDetail;
use App\Traits\Fonnte;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Tenggat extends Command
{
    use Fonnte;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tenggat';

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
        $tagihanDetail = TagihanDetail::where('end_date', date('Y-m-d'))->where('status', 'BELUM')->get();

        foreach ($tagihanDetail as $tagihanDetails) {
            // Log::info($tagihanDetails->biayasDetail->nama_biaya);
            $this->send_message($tagihanDetails->users->phone, 'nih Tagihan ' . $tagihanDetails->biayasDetail->nama_biaya);
        }
    }
}

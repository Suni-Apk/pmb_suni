<?php

namespace App\Console\Commands;

use App\Models\TagihanDetail;
use App\Traits\Fonnte;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BeforeTenggat extends Command
{
    use Fonnte;
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
        $tagihanDetail = TagihanDetail::all();
        // Log::info('sdasd');
        foreach ($tagihanDetail as $keys => $value) {
            $end_date = strtotime('-10 days', strtotime($value->end_date));
            $end_dates = date('Y-m-d', $end_date);
            if ($end_dates == date('Y-m-d') && $value->status == 'BELUM') {
                if ($value->users->biodata->program_belajar == 'S1') {
                    // Log::info($value->users->phone);

                    $this->send_message($value->users->phone, 'Ada tagihan yang harus dibayar sebelum ' .  route('mahasiswa.tagihan.index'));
                } else if ($value->users->biodata->program_belajar == 'KURSUS') {
                    // Log::info($value->users->phone);
                    $this->send_message($value->users->phone, 'Ada tagihan yang harus dibayar sebelum ' .  route('kursus.tagihan.index'));
                }
            }
        }
    }
}

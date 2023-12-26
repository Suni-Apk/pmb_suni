<?php

namespace App\Console\Commands;

use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Traits\Fonnte;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AfterTenggat extends Command
{
    use Fonnte;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:after-tenggat';

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
        $tagihanDetail = TagihanDetail::where('status', 'BELUM')->get();
        foreach ($tagihanDetail as $keys => $value) {
            if ($value->end_date < date('Y-m-d')) {
                if ($value->users->biodata->program_belajar == 'S1') {
                    $this->send_message($value->users->phone, 'Ada tagihan nunggak yang harus dibayar sebelum ' . $value->biayasDetail->nama_biaya . ' RP.' . $value->amount . ' ' .  route('mahasiswa.tagihan.index'));
                    TagihanDetail::where('id', $value->id)->update([
                        'status' => 'NUNGGAK',
                    ]);
                    // Log::info($value->users->phone);
                } else if ($value->users->biodata->program_belajar == 'KURSUS') {
                    $this->send_message($value->users->phone, 'Ada tagihan Kursus nunggak yang harus dibayar sebelum ' . $value->biayasDetail->nama_biaya . $value->amount .  route('kursus.tagihan.index'));
                    TagihanDetail::where('id', $value->id)->update([
                        'status' => 'NUNGGAK',
                    ]);
                    // Log::info($value->users->phone);
                }
            }
        }
    }
}

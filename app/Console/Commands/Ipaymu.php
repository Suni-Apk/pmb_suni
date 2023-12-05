<?php

namespace App\Console\Commands;

use App\Models\Transaksi;
use App\Models\User;
use App\Traits\Fonnte;
use Illuminate\Console\Command;

class Ipaymu extends Command
{
    use Fonnte;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ipaymu';

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
        $pembayaran = Transaksi::all();

        foreach ($pembayaran as $pembayarans) {
            if ($pembayarans->status == 'pending') {
                $times  = strtotime($pembayarans->created_at) + (86400 * 1);
                if ($times < time()) {
                    $pembayarans->update([
                        'status' => 'expired',
                    ]);
                    $user = User::where('id', $pembayarans->user_id)->first();
                    $send = 'Assalamualaikum warahmatullahi wabarakatu yang terhormat Bapak / ibu ' . $pembayarans->user->name . ' Kami informasikan ada pembayaran yang sudah expired jika ingin membayar silahkan membayar ulang';

                    $this->send_message($pembayarans->user->phone, $send);
                    // Log::info($pembayarans->users->telepon);
                }
            }
        }
    }
}

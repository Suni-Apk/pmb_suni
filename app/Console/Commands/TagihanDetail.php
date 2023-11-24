<?php

namespace App\Console\Commands;

use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Document;
use App\Models\Tagihan;
use App\Models\Transaksi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class TagihanDetail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tagihan-detail';

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
        //
    }
}

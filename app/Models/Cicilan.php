<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tagihan_details',
        'start_date',
        'end_date',
        'nama_cicilan',
        'harga',
        'status',
        'id_transactions',
    ];

    public function tagihanDetail()
    {
        $this->belongsTo(TagihanDetail::class, 'id_tagihan_details');
    }
    public function transaction()
    {
        $this->hasOne(Transaksi::class, 'id_cicilans');
    }
    public function transactions()
    {
        $this->belongsTo(Cicilan::class, 'id_transactions');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_detail_id',
        'user_id',
        'status',
        'total',
        'payment_link',
        'program_belajar',
        'jenis_pembayaran',
        'jenis_tagihan',
        'no_invoice'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagihanDetails()
    {
        return $this->hasMany(TagihanDetail::class, 'id_transactions');
    }
}

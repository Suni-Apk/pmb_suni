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
        'no_invoice',
        'id_cicilans',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagihanDetails()
    {
        return $this->belongsTo(TagihanDetail::class, 'tagihan_detail_id');
    }
    public function cicilan()
    {
        return $this->belongsTo(Cicilan::class, 'id_cicilans');
    }
    public function cicilans()
    {
        return $this->hasMany(Cicilan::class);
    }
}
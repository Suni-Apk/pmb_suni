<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_tagihans",
        "id_biayas",
        "id_transactions",
        "id_users",
        "amount",
        "start_date",
        "status",
        "end_date",
        "before_end",
    ];

    public function tagihans()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihans');
    }
    public function biayasDetail()
    {
        return $this->belongsTo(Biaya::class, 'id_biayas');
    }
}

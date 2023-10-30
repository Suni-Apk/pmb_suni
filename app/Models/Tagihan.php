<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_biayas",
        "start_date",
        "end_date",
        "mounth",
        "amount",
    ];
}

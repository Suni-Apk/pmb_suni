<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama_biaya",
        "jenis_biaya",
        "program_belajar",
        "id_angkatans",
        "id_jurusans",
        "start_date",
        "end_date",
        "mounth",
        "amount"
    ];
}

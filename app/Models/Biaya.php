<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_angkatans',
        'id_jurusans',
        'nama_biaya',
        'jenis_biaya',
        'program_belajar',
    ];
}

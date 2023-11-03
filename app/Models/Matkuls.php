<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkuls extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jurusans',
        'id_semesters',
        'nama_matkuls',
        'nama_dosen',
        'mulai',
        'selesai',
        'tanggal'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusans');
    }
    public function semesters()
    {
        return $this->belongsTo(Semester::class, 'id_semesters');
    }
}

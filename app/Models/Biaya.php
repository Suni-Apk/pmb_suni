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
        'id_kursus',
        'nama_biaya',
        'jenis_biaya',
        'program_belajar',
    ];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
    public function kursus()
    {
        return $this->belongsTo(Course::class, 'id_kursus');
    }
    public function tagihanDetail()
    {
        return $this->hasMany(TagihanDetail::class, 'id_biayas');
    }
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_angkatans');
    }

    public function jurusans()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusans');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tahun_ajarans',
        'name',
        'code'
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajarans');
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function matkuls()
    {
        return $this->hasMany(Matkuls::class);
    }
}

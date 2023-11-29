<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name', //nama linknya
        'url', // link URL nya
        'id_tahun_ajarans', // relasi ke angkatan berapa
        'id_jurusans', // relasi ke jurusan apa // nullable
        'id_courses', // untuk bikin link untuk kursus yg mana // nullable
        'gender', // cowo apa cewe atau semuanya
        'type' //whatsapp, atau zoom
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajarans');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusans');
    }

    public function kursus()
    {
        return $this->belongsTo(Course::class, 'id_courses');
    }
}

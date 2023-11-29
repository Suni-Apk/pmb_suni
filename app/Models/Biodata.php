<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'angkatan_id',
        'course_id',
        'jurusan_id',
        'program_belajar',
        'image',
        'birthdate',
        'birthplace',
        'provinsi',
        'kota',
        'kecamatan',
        'address',
        'profesi',
        'baca_quran',
        'last_graduate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function angkatan()
    {
        return $this->belongsTo(TahunAjaran::class, 'angkatan_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function semesters()
    {
        return $this->belongsTo(Semester::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

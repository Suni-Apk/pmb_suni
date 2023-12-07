<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function semesters()
    {
        return $this->hasMany(Semester::class, 'id_tahun_ajarans');
    }

    public function matkuls()
    {
        return $this->hasMany(Matkuls::class);
    }

    public function biodatas()
    {
        return $this->hasMany(Biodata::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class, 'id_jurusans');
    }
}

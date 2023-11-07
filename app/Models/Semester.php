<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jurusans',
        'name'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id');
    }

    public function matkuls()
    {   
        return $this->hasMany(Matkuls::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'status',
        'start_at',
        'end_at'
    ];

    public function jurusans()
    {
        return $this->hasMany(Jurusan::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'angkatan_id');
    }

    public function biodatas()
    {
        return $this->hasMany(Biodata::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class, 'id_tahun_ajarans');
    }
}

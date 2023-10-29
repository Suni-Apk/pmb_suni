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
}
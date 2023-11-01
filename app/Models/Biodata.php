<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'birthdate',
        'birthplace',
        'provinsi',
        'kota',
        'kecamatan',
        'address',
        'last_graduate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

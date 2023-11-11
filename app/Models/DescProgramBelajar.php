<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescProgramBelajar extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        's1',
        'kursus',
    ];
}

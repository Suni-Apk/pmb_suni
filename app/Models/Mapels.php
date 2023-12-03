<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapels extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_courses',
        'name',
        'description',
        'guru',
        'mulai',
        'status',
        'selesai',
        'hari'
    ];
    public function kursus()
    {
        return $this->belongsTo(Course::class, 'id_courses');
    }
}

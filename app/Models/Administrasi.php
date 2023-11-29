<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_belajar',
        'amount',
        'course_id',
        'id_tahunAjaran',
    ];
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahunAjaran');
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

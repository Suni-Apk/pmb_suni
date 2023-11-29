<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescProgramBelajar extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'course_id',
        'title',
        'keyword',
        'desc',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

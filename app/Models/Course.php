<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'notes'
    ];

    public function biodata()
    {
        return $this->hasMany(Biodata::class);
    }

    public function mapel()
    {
        return $this->hasMany(Mapels::class, 'id_courses');
    }

    public function links()
    {
        return $this->hasMany(Links::class);
    }
}

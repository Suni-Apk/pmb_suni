<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'notes',
        'keyword',
    ];

    protected $casts = [
        'notes' => 'array',
    ];

    public function descProgram()
    {
        return $this->hasOne(DescProgramBelajar::class);
    }

    public function administrasi()
    {
        return $this->hasOne(Administrasi::class);
    }

    public function biodata()
    {
        return $this->hasMany(Biodata::class);
    }

    public function biaya()
    {
        return $this->hasMany(Biaya::class);
    }

    public function mapel()
    {
        return $this->hasMany(Mapels::class, 'id_courses');
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}

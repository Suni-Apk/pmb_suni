<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'title',
        'author',
        'image',
        'type',
        'desc',
        'target',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }
}

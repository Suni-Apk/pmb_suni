<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_tagihans",
        "id_transactions",
        "id_users",
        "amount",
        "start_date",
        "end_date",
        "before_end",
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;

    protected $fillable = [
        'notif_otp',
        'notif_isi_biodata_formal',
        'notif_isi_biodata_nonformal',
        'notif_isi_document',
        'notif_administrasi_formal',
        'notif_administrasi_nonformal'
    ];
}

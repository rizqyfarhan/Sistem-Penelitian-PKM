<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HKIPenelitian extends Model
{
    protected $table = 'hki_penelitian';

    protected $fillable = [
        'judul',
        'nama_pemegang',
        'nomor_sertifikat',
        'file'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurnalPKM extends Model
{
    protected $table = 'jurnal_pkm';

    protected $fillable = [
        'judul',
        'penerbit',
        'tahun',
        'volume',
        'nomor',
        'halaman',
        'url',
        'file',
    ];
}
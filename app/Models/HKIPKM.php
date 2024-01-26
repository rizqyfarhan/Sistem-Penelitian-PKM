<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HKIPKM extends Model
{
    protected $table = 'hki_pkm';

    protected $fillable = [
        'judul',
        'nama_pemegang',
        'nomor_sertifikat',
        'file'
    ];
}
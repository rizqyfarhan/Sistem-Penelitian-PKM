<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HKIPenelitian extends Model
{
    protected $table = 'hki_penelitian';

    protected $fillable = [
        'judul',
        'nama_pemegang',
        'nomor_sertifikat',
        'file',
        'hki_penelitian_nrk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'hki_penelitian_nrk', 'nrk');
    }
}
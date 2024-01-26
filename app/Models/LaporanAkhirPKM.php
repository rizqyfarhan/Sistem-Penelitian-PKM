<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanAkhirPKM extends Model
{
    protected $table = 'laporan_akhir_pkm';

    protected $fillable = [
        'judul',
        'file',
        'akhir_pkm_id',
    ];

    public function proposalPenelitian()
    {
        return $this->belongsTo(ProposalPKM::class, 'akhir_pkm_id');
    }
}
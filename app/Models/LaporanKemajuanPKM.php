<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKemajuanPKM extends Model
{
    protected $table = 'laporan_kemajuan_pkm';

    protected $fillable = [
        'judul',
        'file',
        'kemajuan_pkm_id',
    ];

    public function proposalPenelitian()
    {
        return $this->belongsTo(ProposalPKM::class, 'kemajuan_pkm_id');
    }
}
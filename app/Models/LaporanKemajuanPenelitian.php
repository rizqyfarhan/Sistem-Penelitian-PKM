<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKemajuanPenelitian extends Model
{
    protected $table = 'laporan_kemajuan_penelitian';

    protected $fillable = [
        'judul',
        'file',
        'laporan_kemajuan_nrk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'laporan_kemajuan_nrk', 'nrk');
    }

    public function proposalPenelitian()
    {
        return $this->belongsTo(ProposalPenelitian::class, 'laporan_kemajuan_nrk', 'nrk');
    }
}
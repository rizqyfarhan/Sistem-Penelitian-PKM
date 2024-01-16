<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKemajuanPenelitian extends Model
{
    protected $table = 'laporan_kemajuan_penelitian';

    protected $fillable = [
        'judul',
        'file',
        'laporan_kemajuan_id',
    ];

    public function proposalPenelitian()
    {
        return $this->belongsTo(ProposalPenelitian::class, 'laporan_kemajuan_id');
    }
}
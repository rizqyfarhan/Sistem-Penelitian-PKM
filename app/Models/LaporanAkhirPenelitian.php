<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAkhirPenelitian extends Model
{
    protected $table = 'laporan_akhir_penelitian';

    protected $fillable = [
        'judul',
        'file',
        'laporan_akhir_id',
    ];

    public function proposalPenelitian()
    {
        return $this->belongsTo(ProposalPenelitian::class, 'laporan_akhir_id');
    }
}
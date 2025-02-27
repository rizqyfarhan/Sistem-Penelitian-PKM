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
        'laporan_akhir_nrk',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'laporan_akhir_nrk', 'nrk');
    }

    public function proposalPenelitian()
    {
        return $this->belongsTo(ProposalPenelitian::class, 'laporan_akhir_nrk', 'nrk');
    }
}
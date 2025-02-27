<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalPenelitian extends Model
{
    protected $table = 'proposal_penelitian';

    protected $primaryKey = 'nrk';

    protected $fillable = [
        'judul',
        'ketua_peneliti',
        'nidn',
        'nrk',
        'program_studi',
        'semester',
        'tahun_akademik',
        'sumber_dana',
        'nama_pendana',
        'jumlah_dana',
        'file',
        'user_nrk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_nrk', 'nrk');
    }

    public function laporanKemajuanPenelitian()
    {
        return $this->hasMany(LaporanKemajuanPenelitian::class, 'laporan_kemajuan_nrk', 'nrk');
    }
}
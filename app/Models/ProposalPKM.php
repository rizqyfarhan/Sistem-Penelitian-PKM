<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalPKM extends Model
{
    protected $table = 'proposal_pkm';

    protected $fillable = [
        'judul',
        'nama_pelaksana',
        'nidn',
        'nrk',
        'program_studi',
        'semester',
        'tahun_akademik',
        'nama_mitra',
        'alamat_mitra',
        'file',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}